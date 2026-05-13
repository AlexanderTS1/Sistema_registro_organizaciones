<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('organizacions', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | SOLO AGREGAR SI NO EXISTEN
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('organizacions', 'representante_id')) {

                $table->foreignId('representante_id')
                    ->nullable()
                    ->constrained('personas')
                    ->nullOnDelete();
            }

            if (!Schema::hasColumn('organizacions', 'acta_constitucion')) {

                $table->string('acta_constitucion')->nullable();
            }

            if (!Schema::hasColumn('organizacions', 'padron_socios')) {

                $table->string('padron_socios')->nullable();
            }

            if (!Schema::hasColumn('organizacions', 'acta_eleccion_directiva')) {

                $table->string('acta_eleccion_directiva')->nullable();
            }

            if (!Schema::hasColumn('organizacions', 'partida_registral')) {

                $table->string('partida_registral')->nullable();
            }

            /*
            |--------------------------------------------------------------------------
            | NO VOLVER A CREAR
            |--------------------------------------------------------------------------
            |
            | tipo_organizacion ya existe
            |
            */
        });
    }

    public function down(): void
    {
        Schema::table('organizacions', function (Blueprint $table) {

            if (Schema::hasColumn('organizacions', 'representante_id')) {

                $table->dropConstrainedForeignId('representante_id');
            }

            $columnas = [

                'acta_constitucion',
                'padron_socios',
                'acta_eleccion_directiva',
                'partida_registral',
            ];

            foreach ($columnas as $columna) {

                if (Schema::hasColumn('organizacions', $columna)) {

                    $table->dropColumn($columna);
                }
            }
        });
    }
};