<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\OrganizacionResource\Pages;
use App\Filament\Admin\Resources\OrganizacionResource\RelationManagers;
use App\Models\Organizacion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class OrganizacionResource extends Resource
{
    protected static ?string $model = Organizacion::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationGroup = 'Organizaciones';

    protected static ?string $navigationLabel = 'Organizaciones';

    protected static ?string $modelLabel = 'Organización';

    protected static ?string $pluralModelLabel = 'Organizaciones';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Datos de la Organización')
                    ->schema([

                        Forms\Components\TextInput::make('codigo_expediente')
                            ->label('Código Expediente')
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\Select::make('tipo_organizacion')
                            ->label('Tipo Organización')
                            ->options([
                                'social' => 'Social',
                                'base' => 'Base',
                                'comunal' => 'Comunal',
                                'vecinal' => 'Vecinal',
                                'cultural' => 'Cultural',
                                'regantes' => 'Regantes',
                                'otros' => 'Otros',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('razon_social')
                            ->required(),

                        Forms\Components\TextInput::make('direccion'),

                        Forms\Components\Select::make('representante_id')
                            ->relationship(
                                'representante',
                                'nombres'
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                    ])
                    ->columns(2),

                Forms\Components\Section::make('Documentos PDF')
                    ->schema([

                        Forms\Components\FileUpload::make('acta_constitucion')
                            ->acceptedFileTypes([
                                'application/pdf'
                            ])
                            ->directory('documentos')
                            ->required(),

                        Forms\Components\FileUpload::make('padron_socios')
                            ->acceptedFileTypes([
                                'application/pdf'
                            ])
                            ->directory('documentos')
                            ->required(),

                        Forms\Components\FileUpload::make('acta_eleccion_directiva')
                            ->acceptedFileTypes([
                                'application/pdf'
                            ])
                            ->directory('documentos')
                            ->required(),

                        Forms\Components\FileUpload::make('partida_registral')
                            ->acceptedFileTypes([
                                'application/pdf'
                            ])
                            ->directory('documentos'),

                    ])
                    ->columns(2),

                Forms\Components\Section::make('Evaluación')
                    ->schema([

                        Forms\Components\Select::make('estado')
                            ->options([
                                'registrado' => 'Registrado',
                                'en_evaluacion' => 'En evaluación',
                                'observado' => 'Observado',
                                'aceptado' => 'Aceptado',
                            ])
                            ->default('registrado')
                            ->required(),

                        Forms\Components\Textarea::make('observaciones')
                            ->rows(4),

                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('codigo_expediente')
                    ->label('Expediente')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('razon_social')
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('tipo_organizacion'),

                Tables\Columns\TextColumn::make('representante.nombre_completo')
                    ->label('Representante'),

                Tables\Columns\BadgeColumn::make('estado')
                    ->colors([
                        'gray' => 'registrado',
                        'warning' => 'en_evaluacion',
                        'danger' => 'observado',
                        'success' => 'aceptado',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha Registro')
                    ->dateTime('d/m/Y'),

            ])
            ->filters([

                Tables\Filters\SelectFilter::make('estado')
                    ->options([
                        'registrado' => 'Registrado',
                        'en_evaluacion' => 'En evaluación',
                        'observado' => 'Observado',
                        'aceptado' => 'Aceptado',
                    ]),

            ])
            ->actions([

                Tables\Actions\ViewAction::make(),

                Tables\Actions\EditAction::make(),

            ])
            ->bulkActions([

                Tables\Actions\DeleteBulkAction::make(),

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