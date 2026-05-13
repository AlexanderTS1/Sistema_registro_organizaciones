<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';

    protected $fillable = [
        'organizacion_id',

        'dni',
        'nombres',
        'apellidos',
        'domicilio',
        'distrito',
        'provincia',
        'departamento',
        'telefono',
        'correo',
    ];

    protected $appends = [
        'nombre_completo'
    ];

    /**
     * RELACIÓN CORRECTA
     */
    public function organizacion(): BelongsTo
    {
        return $this->belongsTo(Organizacion::class, 'organizacion_id');
    }

    /**
     * ACCESSOR
     */
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombres} {$this->apellidos}";
    }
}