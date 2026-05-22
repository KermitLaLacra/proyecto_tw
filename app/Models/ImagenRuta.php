<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenRuta extends Model
{
    protected $table = 'imagenes';
    protected $fillable = [
        'ruta_id',
        'archivo',
        'orden',
    ];

    public function rutas()
    {
        return $this->belongsTo(Ruta::class);
    }
}
