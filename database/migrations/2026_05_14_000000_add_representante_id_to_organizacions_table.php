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
        Schema::table('organizacions', function (Blueprint $table) {
            
            $table->foreignId('representante_id')
                ->after('user_id')
                ->nullable()
                ->constrained('personas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organizacions', function (Blueprint $table) {
            
            $table->dropForeign(['representante_id']);
            $table->dropColumn('representante_id');
        });
    }
};
