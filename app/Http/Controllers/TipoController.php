<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipos = Tipo::all();
        return view('tipos.index', ['tipos' => $tipos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'icono' => 'required',
        ]);

        Tipo::create([
            'nombre' => $request->nombre,
            'icono' => $request->icono,
        ]);

        return redirect('/tipos');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tipo = Tipo::find($id);
        
        return view('tipos.show', ['tipo' => $tipo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tipo = Tipo::find($id);

        return view('tipos.edit', ['tipo' => $tipo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tipo = Tipo::find($id);

        $tipo->nombre = $request->nombre;
        $tipo->icono = $request->icono;
        $tipo->save();

        return redirect('/tipos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tipo = Tipo::find($id);

        $tipo->delete();

        return redirect('/tipos');
    }
}
