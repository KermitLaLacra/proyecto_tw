<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipos';
    protected $fillable = [
        'nombre',
        'icono',
    ];

    public function rutas()
    {
        return $this->belongsToMany(Ruta::class, 'tipo_ruta');
    }
}
