<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('organizacions', function (Blueprint $table) {

            $table->string('codigo_expediente')
                ->unique()
                ->after('id');

        });
    }

    public function down(): void
    {
        Schema::table('organizacions', function (Blueprint $table) {

            $table->dropColumn('codigo_expediente');

        });
    }
};