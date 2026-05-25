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
        $rutasFavoritas = auth()->user()->rutasFavoritas;
        return view('favoritos.index', compact('rutasFavoritas'));
    }

    /**
     * Añade o quita una ruta de favoritos (Toggle).
     */
    public function toggle(Ruta $ruta)
    {
        $usuario = auth()->user();

        $usuario->rutasFavoritas()->toggle($ruta->id);

        return redirect()->back()->with('status', 'Lista de favoritos actualizada.');
    }
}
