<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Valoracion;

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
        // Añadimos el required para ruta_id por seguridad
        $request->validate([
            'ruta_id' => 'required|exists:rutas,id',
            'puntuacion' => 'required|integer|min:1|max:5',
            'valoracion' => 'required|string|max:1000',
        ]);

        Valoracion::create([
            'ruta_id' => $request->ruta_id,
            'user_id' => auth()->id(),
            'puntuacion' => $request->puntuacion,
            'valoracion' => $request->valoracion,
        ]);

        // En lugar de redirigir a un listado genérico, te devuelve a la misma ruta que estabas viendo
        return back()->with('status', '¡Gracias por compartir tu opinión sobre la ruta!');
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
