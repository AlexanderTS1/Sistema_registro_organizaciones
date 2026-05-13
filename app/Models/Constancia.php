<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Constancia extends Model
{
    protected $table = 'constancias';

    protected $fillable = [

        'organizacion_id',
        'archivo_pdf',
        'codigo_verificacion',
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
}