<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    protected $fillable = [
        'nombre',
        'km',
        'descripcion',
        'imagen',
    ];

    public function tipos()
    {
        return $this->belongsToMany(Tipo::class, 'tipo_ruta');
    }

    public function imagenes()
    {
        return $this->hasMany(ImagenRuta::class);
    }
}
