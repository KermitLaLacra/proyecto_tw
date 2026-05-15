<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipo', function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->string('icono')->nullable();
            $table->timestamps();
        });

        Schema::create('ruta', function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->double('km', 5, 2);
            $table->string('descripcion');
            $table->string('imagen')->nullable();
        });

        Schema::create('imagenes_ruta', function(Blueprint $table){
            $table->id();
            $table->foreignId('ruta_id')->constrained('ruta');
            $table->string('archivo');
            $table->integer('orden')->default(0);
            $table->timestamps();
        });

        Schema::create('tipo_ruta', function(Blueprint $table){
            $table->foreignId('tipo_id')->constrained('tipo');
            $table->foreignId('ruta_id')->constrained('ruta');
        });
    }

    public function down(): void 
    {
        Schema::dropIfExists('tipo');
        Schema::dropIfExists('ruta');
        Schema::dropIfExists('imagenes_ruta');
        Schema::dropIfExists('tipo_tura');
    }
};