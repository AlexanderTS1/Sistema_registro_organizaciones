<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Constancia extends Model
{
    protected $table = 'constancias';

    protected $fillable = [
        'organizacion_id',
        'archivo_pdf',
    ];

    public function organizacion()
    {
        return $this->belongsTo(Organizacion::class);
    }
}