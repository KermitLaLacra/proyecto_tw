<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rutas', function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->double('km', 5, 2);
            $table->integer('desnivel')->default(0);
            $table->boolean('es_oficial')->default(false);
            $table->text('descripcion');
            $table->string('imagen')->nullable();
            $table->enum('tipo_ruta', ['turismo', 'senderismo']);
            $table->enum('dificultad', ['muy_facil', 'facil', 'intermedio', 'dificil', 'muy_dificil']);
            $table->foreignId('lugar_id')->constrained('lugar');
            $table->timestamps();
        });
    }

    public function down(): void 
    {
        Schema::dropIfExists('rutas');
    }
};