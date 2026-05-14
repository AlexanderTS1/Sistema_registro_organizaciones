<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('constancias', function (Blueprint $table) {

            $table->id();

            $table->foreignId('organizacion_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('codigo_constancia')->unique();

            $table->string('archivo_pdf')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('constancias');
    }
};