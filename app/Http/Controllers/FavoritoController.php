<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruta;

class FavoritoController extends Controller
{
    /**
     * Muestra la lista de rutas favoritas del usuario logueado.
     */
    public function index()
    {
        // Obtenemos el usuario autenticado y sus rutas favoritas
        $rutasFavoritas = auth()->user()->rutasFavoritas;

        // Retorna la vista donde listarás sus favoritos
        return view('favoritos.index', compact('rutasFavoritas'));
    }

    /**
     * Añade o quita una ruta de favoritos (Toggle).
     */
    public function toggle(Ruta $ruta)
    {
        $usuario = auth()->user();

        // El método toggle añade si no existe, o elimina si ya existe en la tabla pivote
        $usuario->rutasFavoritas()->toggle($ruta->id);

        return redirect()->back()->with('status', 'Lista de favoritos actualizada.');
    }
}
