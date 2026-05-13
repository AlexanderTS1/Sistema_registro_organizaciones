<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('historial_estados', function (Blueprint $table) {

            $table->foreignId('organizacion_id')
                ->after('id')
                ->constrained('organizacions')
                ->onDelete('cascade');

            $table->string('estado');

            $table->text('observacion')
                ->nullable();

            $table->dateTime('fecha');
        });
    }

    public function down(): void
    {
        Schema::table('historial_estados', function (Blueprint $table) {

            $table->dropForeign(['organizacion_id']);

            $table->dropColumn([
                'organizacion_id',
                'estado',
                'observacion',
                'fecha'
            ]);
        });
    }
};