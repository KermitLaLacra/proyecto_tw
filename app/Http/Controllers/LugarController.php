<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lugar;

class LugarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lugares = Lugar::all();

        return view('lugares.index', ['lugares' => $lugares]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rutas = Ruta::all();

        return view('create', ['rutas' => $rutas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lugar' => 'required',
        ]);

        $lugar = Lugar::create([
            'lugar' => $request->lugar,
        ]);

        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lugar = Lugar::with(['rutas'])->find($id);

        return view('lugares.show', ['lugar' => $lugar]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lugar = Lugar::find($id);
        $rutas = Ruta::all();

        return view('lugares.edit', ['lugar' => $lugar, 'rutas' => $rutas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lugar = Lugar::find($id);

        $lugar->lugar = $request->lugar;

        $lugar->save();

        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lugar = Lugar::find($id);

        $lugar->delete();

        return redirect('/dashboard');
    }
}
