<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void 
    {
        Schema::create('tipo_ruta', function(Blueprint $table){
            $table->foreignId('tipo_id')->constrained('tipo');
            $table->foreignId('ruta_id')->constrained('ruta');
        });
    }

    public function down(): void 
    {
        Schema::dropIfExists('tipo_ruta');
    }
};