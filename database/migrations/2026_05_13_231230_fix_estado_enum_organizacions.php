<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE organizacions
            MODIFY estado ENUM(
                'registrado',
                'en_evaluacion',
                'observado',
                'aceptado'
            ) NOT NULL DEFAULT 'registrado'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE organizacions
            MODIFY estado ENUM(
                'activo',
                'inactivo',
                'pendiente'
            ) NOT NULL DEFAULT 'activo'
        ");
    }
};