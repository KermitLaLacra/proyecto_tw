<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValoracionController extends Controller
{
    /**
     * Muestra una lista de todas las valoraciones disponibles en la base de datos.
     */
    public function index()
    {
        $valoraciones = Valoracion::all();

        return view('valoraciones.index', ['valoraciones' => $valoraciones]);
    }

    /**
     * Muestra el formulario para crear una nueva valoración.
     */
    public function create()
    {
        return view('valoraciones.create');
    }

    /**
     * Almacena la nueva valoración en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'puntuacion' => 'required|integer|min:0|max:5',
            'valoracion' => 'nullable|string|max:1000',
        ]);

        $valoracion = Valoracion::create([
            'ruta_id' => $request->ruta_id,
            'user_id' => auth()->id(),
            'puntuacion' => $request->puntuacion,
            'valoracion' => $request->valoracion,
        ]);

        return redirect('/valoracion');
    }

    /**
     * Muestra los detalles de una valoración específica.
     */
    public function show(string $id)
    {
        $valoracion = Valoracion::find($id);

        return view('valoraciones.show', ['valoracion' => $valoracion]);
    }

    /**
     * Muestra el formulario para editar una valoración existente.
     */
    public function edit(string $id)
    {
        $valoracion = Valoracion::find($id);

        return view('valoraciones.edit', ['valoracion' => $valoracion]);
    }

    /**
     * Actualiza la valoración especificada en el almacenamiento.
     */
    public function update(Request $request, string $id)
    {
        $valoracion = Valoracion::find($id);

        $valoracion->puntuacion = $request->puntuacion;
        $valoracion->valoracion = $request->valoracion;
        $valoracion->save();

        return redirect('/valoracion');
    }

    /**
     * Elimina la valoración de la base de datos.
     */
    public function destroy(string $id)
    {
        $valoracion = Valoracion::find($id);

        $valoracion->delete();

        return redirect('/valoracion');
    }
}
