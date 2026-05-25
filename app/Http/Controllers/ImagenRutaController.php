<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagenRutaController extends Controller
{
    /**
     * Muesrta una lista de todas las imágenes de rutas.
     */
    public function index()
    {
        $imagenes = ImagenRuta::all();

        return view('imagenes.index', ['imagenes' => $imagenes]);
    }

    /**
     * Muestra el formulario para crear una nueva imagen de ruta.
     */
    public function create()
    {
        return view('imagenes.create');
    }

    /**
     * Almacena una nueva imagen de ruta en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ruta_id' => 'required|exists:ruta,id',
            'archivo' => 'required',
            'orden' => 'required',
        ]);

        ImagenRuta::create([
            'ruta_id' => $request->ruta_id,
            'archivo' => $request->archivo,
            'orden' => $request->orden,
        ]);

        return redirect('/imagenes');
    }

    /**
     * Muestra los detalles de una imagen de ruta específica.
     */
    public function show(string $id)
    {
        $imagen = ImagenRuta::find($id);

        return view('imagenes.show', ['imagen' => $imagen]);
    }

    /**
     * Muestra el formulario para editar una imagen de ruta existente.
     */
    public function edit(string $id)
    {
        $imagen = ImagenRuta::find($id);

        return view('imagenes.edit', ['imagen' => $imagen]);
    }

    /**
     * Actualiza una imagen de ruta existente en la base de datos.
     */
    public function update(Request $request, string $id)
    {
        $imagen = ImagenRuta::find($id);

        $imagen->ruta_id = $request->ruta_id;
        $imagen->archivo = $request->archivo;
        $imagen->orden = $request->orden;
        $imagen->save();

        return redirect('/imagenes');
    }

    /**
     * Elimina una imagen de ruta de la base de datos.
     */
    public function destroy(string $id)
    {
        $imagen = ImagenRuta::find($id);

        $imagen->delete();

        return redirect('/imagenes');
    }
}
