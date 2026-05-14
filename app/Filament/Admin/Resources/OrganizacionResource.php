<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\OrganizacionResource\Pages;
use App\Models\Organizacion;

use Filament\Forms;
use Filament\Forms\Form;

use Filament\Resources\Resource;

use Filament\Tables;
use Filament\Tables\Table;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

use Illuminate\Support\Facades\Mail;
use App\Mail\EstadoOrganizacionMail;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\Constancia;


class OrganizacionResource extends Resource
{
    protected static ?string $model = Organizacion::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'Organizaciones';

    protected static ?string $pluralModelLabel = 'Organizaciones';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Información General')
                    ->schema([

                        TextInput::make('codigo_expediente')
                            ->disabled(),

                        TextInput::make('razon_social')
                            ->disabled(),

                        Select::make('tipo_organizacion')
                            ->options([
                                'social' => 'Social',
                                'base' => 'Base',
                                'comunal' => 'Comunal',
                                'vecinal' => 'Vecinal',
                            ])
                            ->disabled(),

                        Select::make('estado')
                            ->options([
                                'registrado' => 'Registrado',
                                'en_evaluacion' => 'En Evaluación',
                                'observado' => 'Observado',
                                'aceptado' => 'Aceptado',
                            ])
                            ->required(),

                        Textarea::make('observaciones'),

                    ]),

                Section::make('Documentos')
                    ->schema([

                        FileUpload::make('acta_constitucion')
                            ->disk('public')
                            ->directory('documentos')
                            ->downloadable()
                            ->openable(),

                        FileUpload::make('padron_socios')
                            ->disk('public')
                            ->directory('documentos')
                            ->downloadable()
                            ->openable(),

                        FileUpload::make('acta_eleccion_directiva')
                            ->disk('public')
                            ->directory('documentos')
                            ->downloadable()
                            ->openable(),

                        FileUpload::make('partida_registral')
                            ->disk('public')
                            ->directory('documentos')
                            ->downloadable()
                            ->openable()
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('codigo_expediente')
                    ->searchable(),

                TextColumn::make('razon_social')
                    ->searchable(),

                TextColumn::make('tipo_organizacion'),

                TextColumn::make('representante.nombre_completo')
                    ->label('Representante'),

                TextColumn::make('estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {

                        'registrado' => 'gray',

                        'en_evaluacion' => 'warning',

                        'observado' => 'danger',

                        'aceptado' => 'success',

                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i'),

            ])
            ->actions([

                Tables\Actions\ViewAction::make(),

                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('aprobar')

                    ->color('success')

                    ->icon('heroicon-o-check-circle')

                    ->requiresConfirmation()

                    ->action(function ($record) {

                        $record->update([
                            'estado' => 'aceptado'
                        ]);

                        $codigoConstancia =
                            'CONST-' . date('Y') . '-' .
                            str_pad($record->id, 5, '0', STR_PAD_LEFT);

                        $constancia = Constancia::create([

                            'organizacion_id' => $record->id,

                            'codigo_constancia' => $codigoConstancia,

                        ]);

                        $pdf = Pdf::loadView(
                            'pdf.constancia-organizacion',
                            [
                                'organizacion' => $record,
                                'constancia' => $constancia,
                            ]
                        );

                        $nombreArchivo =
                            'constancias/' .
                            $codigoConstancia . '.pdf';

                        Storage::disk('public')->put(
                            $nombreArchivo,
                            $pdf->output()
                        );

                        $constancia->update([
                            'archivo_pdf' => $nombreArchivo,
                        ]);

                    }),

                    

                Tables\Actions\Action::make('observar')

                    ->label('Observar')

                    ->color('danger')

                    ->icon('heroicon-o-x-circle')

                    ->form([

                        Textarea::make('observaciones')
                            ->label('Motivo de Observación')
                            ->required()
                            ->rows(5),

                    ])

                    ->action(function ($record, array $data) {

                        $record->update([

                            'estado' => 'observado',

                            'observaciones' => $data['observaciones'],

                        ]);

                        Mail::to($record->representante->correo)
                            ->send(new EstadoOrganizacionMail($record));

                    }),
                /*
                |------------------------------------------------------------------
                | DESCARGAR CONSTANCIA PDF
                |------------------------------------------------------------------
                */

                Tables\Actions\Action::make('descargar_constancia')

                    ->label('Constancia')

                    ->icon('heroicon-o-document-arrow-down')

                    ->color('info')

                    ->url(fn ($record) =>
                        asset('storage/' . $record->constancia->archivo_pdf)
                    )

                    ->openUrlInNewTab()

                    ->visible(fn ($record) =>
                        $record->constancia !== null
                    ),    
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrganizacions::route('/'),
            'create' => Pages\CreateOrganizacion::route('/create'),
            'edit' => Pages\EditOrganizacion::route('/{record}/edit'),
        ];
    }
}