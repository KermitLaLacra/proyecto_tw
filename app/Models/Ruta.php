<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    protected $table = 'rutas';
    protected $fillable = [
        'nombre',
        'km',
        'descripcion',
        'imagen',
        'tipo_ruta',
        'dificultad',
        'lugar_id',
    ];

    public function tipos()
    {
        return $this->belongsToMany(Tipo::class, 'tipo_ruta');
    }

    public function imagenes()
    {
        return $this->hasMany(ImagenRuta::class);
    }

    public function lugar()
    {
        return $this->belongsTo(Lugar::class);
    }

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class);
    }
    
    public function usuariosQueLaSiguen()
	{
		return $this->belongsToMany(User::class, 'favoritos', 'ruta_id', 'user_id');
	}
}
