<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistorialEstado extends Model
{
    protected $table = 'historial_estados';

    protected $fillable = [

        'organizacion_id',
        'user_id',
        'estado',
        'observacion',
        'fecha',
    ];

    /**
     * RELACIONES
     */

    public function organizacion(): BelongsTo
    {
        return $this->belongsTo(
            Organizacion::class
        );
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}