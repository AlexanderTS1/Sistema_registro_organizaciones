<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Organizacion extends Model
{
    use HasFactory;

    protected $table = 'organizacions';

    protected $fillable = [

        'user_id',

        'codigo_expediente',

        'tipo_organizacion',

        'razon_social',

        'direccion',

        'representante_id',

        'acta_constitucion',

        'padron_socios',

        'acta_eleccion_directiva',

        'partida_registral',

        'estado',

        'observaciones',

        'fecha_evaluacion',

        'fecha_aceptacion',
    ];

    protected $casts = [

        'fecha_evaluacion' => 'datetime',

        'fecha_aceptacion' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($organizacion) {

            $ultimoId = self::max('id') + 1;

            $organizacion->codigo_expediente =
                'ORG-' . date('Y') . '-' .
                str_pad($ultimoId, 5, '0', STR_PAD_LEFT);

            if (!$organizacion->estado) {

                $organizacion->estado = 'registrado';
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function personas(): HasMany
    {
        return $this->hasMany(Persona::class, 'organizacion_id');
    }

    public function representante(): BelongsTo
    {
        return $this->belongsTo(Persona::class, 'representante_id');
    }

    public function historialEstados(): HasMany
    {
        return $this->hasMany(HistorialEstado::class);
    }

    public function constancia(): HasOne
    {
        return $this->hasOne(Constancia::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    public function getEstadoColorAttribute(): string
    {
        return match ($this->estado) {

            'registrado' => 'gray',

            'en_evaluacion' => 'warning',

            'observado' => 'danger',

            'aceptado' => 'success',

            default => 'gray',
        };
    }
}