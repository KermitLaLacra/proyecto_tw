<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void 
    {
        Schema::create('imagenes', function(Blueprint $table){
            $table->id();
            $table->foreignId('ruta_id')->constrained('ruta');
            $table->string('archivo');
            $table->integer('orden')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void 
    {
        Schema::dropIfExists('imagenes');
    }
};