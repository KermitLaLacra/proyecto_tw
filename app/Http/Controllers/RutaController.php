<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruta;
use App\Models\Tipo;

class RutaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rutas = Ruta::all();
        return view('rutas.index', ['rutas' => $rutas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipos = Tipo::all();
        return view('create', ['tipos' => $tipos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'km' => 'required|numeric|min:0',
            'descripcion' => 'required',
        ]);

        $ruta = Ruta::create([
            'lugar_id' => $request->lugar_id,
            'nombre' => $request->nombre,
            'km' => $request->km,
            'descripcion' => $request->descripcion,
        ]);

        $ruta->tipos()->attach($request->tipos);

        return redirect('/rutas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ruta = Ruta::with(['tipos', 'imagenes', 'valoraciones'])->find($id);

        return view('rutas.show', ['ruta' => $ruta]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ruta = Ruta::find($id);
        $tipos = Tipo::all();

        return view('rutas.edit', ['ruta' => $ruta, 'tipos' => $tipos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ruta = Ruta::find($id);

        $ruta->nombre = $request->nombre;
        $ruta->km = $request->km;
        $ruta->descripcion = $request->descripcion;
        $ruta->imagen = $request->imagen;
        $ruta->save();

        $ruta->tipos()->sync($request->tipos);

        return redirect('/rutas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ruta = Ruta::find($id);

        $ruta->delete();

        return redirect('/rutas');
    }
}
