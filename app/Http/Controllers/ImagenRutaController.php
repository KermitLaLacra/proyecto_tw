<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagenRutaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $imagenes = ImagenRuta::all();

        return view('imagenes.index', ['imagenes' => $imagenes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('imagenes.create');
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $imagen = ImagenRuta::find($id);

        return view('imagenes.show', ['imagen' => $imagen]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $imagen = ImagenRuta::find($id);

        return view('imagenes.edit', ['imagen' => $imagen]);
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagen = ImagenRuta::find($id);

        $imagen->delete();

        return redirect('/imagenes');
    }
}
