<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valoracion extends Models
{
    protected $table = 'valoracion';
    protected $fillable = [
        'ruta_id',
        'users_id',
        'valoracion',
        'puntuacion',
    ];

    public function rutas()
    {
        return $this->belongsTo(Ruta::class);
    }

    public function users()
    {
        return $this->belongsTo(Users::class);
    }
}