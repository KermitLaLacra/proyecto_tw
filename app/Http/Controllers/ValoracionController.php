<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValoracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $valoraciones = Valoracion::all();

        return view('valoraciones.index', ['valoraciones' => $valoraciones]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('valoraciones.create');
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $valoracion = Valoracion::find($id);

        return view('valoraciones.show', ['valoracion' => $valoracion]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $valoracion = Valoracion::find($id);

        return view('valoraciones.edit', ['valoracion' => $valoracion]);
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $valoracion = Valoracion::find($id);

        $valoracion->delete();

        return redirect('/valoracion');
    }
}
