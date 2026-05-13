<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('organizacions', function (Blueprint $table) {

            $table->foreignId('user_id')
                ->after('id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('razon_social');

            $table->string('ruc')
                ->unique();

            $table->string('direccion')
                ->nullable();

            $table->string('telefono')
                ->nullable();

            $table->string('email')
                ->nullable();

            $table->enum('estado', [
                'activo',
                'inactivo',
                'pendiente'
            ])->default('activo');
        });
    }

    public function down(): void
    {
        Schema::table('organizacions', function (Blueprint $table) {

            $table->dropForeign(['user_id']);

            $table->dropColumn([
                'user_id',
                'razon_social',
                'ruc',
                'direccion',
                'telefono',
                'email',
                'estado'
            ]);
        });
    }
};