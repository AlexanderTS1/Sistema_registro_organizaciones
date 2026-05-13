<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PersonaResource\Pages;
use App\Filament\Admin\Resources\PersonaResource\RelationManagers;
use App\Models\Persona;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class PersonaResource extends Resource
{
    protected static ?string $model = Persona::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Organizaciones';

    protected static ?string $navigationLabel = 'Personas';

    protected static ?string $modelLabel = 'Persona';

    protected static ?string $pluralModelLabel = 'Personas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Datos Personales')
                    ->schema([

                        Forms\Components\TextInput::make('dni')
                            ->required()
                            ->length(8)
                            ->numeric()
                            ->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make('nombres')
                            ->required(),

                        Forms\Components\TextInput::make('apellidos')
                            ->required(),

                        Forms\Components\TextInput::make('telefono')
                            ->tel(),

                        Forms\Components\TextInput::make('correo')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),

                    ])
                    ->columns(2),

                Forms\Components\Section::make('Dirección')
                    ->schema([

                        Forms\Components\TextInput::make('domicilio'),

                        Forms\Components\TextInput::make('distrito'),

                        Forms\Components\TextInput::make('provincia'),

                        Forms\Components\TextInput::make('departamento'),

                    ])
                    ->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('dni')
                    ->searchable(),

                Tables\Columns\TextColumn::make('nombre_completo')
                    ->label('Representante')
                    ->searchable(),

                Tables\Columns\TextColumn::make('telefono'),

                Tables\Columns\TextColumn::make('correo'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y'),

            ])
            ->filters([
                //
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
            'index' => Pages\ListPersonas::route('/'),
            'create' => Pages\CreatePersona::route('/create'),
            'edit' => Pages\EditPersona::route('/{record}/edit'),
        ];
    }
}