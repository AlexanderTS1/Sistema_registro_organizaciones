<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('personas', function (Blueprint $table) {

            $table->foreignId('organizacion_id')
                ->after('id')
                ->constrained('organizacions')
                ->onDelete('cascade');

            $table->string('nombres');

            $table->string('apellidos');

            $table->string('dni')
                ->unique();

            $table->string('telefono')
                ->nullable();

            $table->string('email')
                ->nullable();

            $table->string('cargo')
                ->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('personas', function (Blueprint $table) {

            $table->dropForeign(['organizacion_id']);

            $table->dropColumn([
                'organizacion_id',
                'nombres',
                'apellidos',
                'dni',
                'telefono',
                'email',
                'cargo'
            ]);
        });
    }
};