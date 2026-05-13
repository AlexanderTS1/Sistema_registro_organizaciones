<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('personas', function (Blueprint $table) {
            
            $table->string('domicilio')->nullable()->after('apellidos');
            $table->string('distrito')->nullable()->after('domicilio');
            $table->string('provincia')->nullable()->after('distrito');
            $table->string('departamento')->nullable()->after('provincia');
            
            // Renombrar email a correo
            $table->renameColumn('email', 'correo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personas', function (Blueprint $table) {
            
            $table->dropColumn([
                'domicilio',
                'distrito',
                'provincia',
                'departamento',
            ]);
            
            $table->renameColumn('correo', 'email');
        });
    }
};
