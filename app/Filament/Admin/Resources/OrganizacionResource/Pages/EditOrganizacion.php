<?php

namespace App\Filament\Admin\Resources\OrganizacionResource\Pages;

use App\Filament\Admin\Resources\OrganizacionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\HistorialEstado;

class EditOrganizacion extends EditRecord
{
    protected static string $resource = OrganizacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
{
    HistorialEstado::create([

        'organizacion_id' => $this->record->id,

        'estado' => $this->record->estado,

        'observacion' => $this->record->observaciones,

        'fecha' => now(),
    ]);
}
}
