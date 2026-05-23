<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruta;
use App\Models\Tipo;
use App\Models\Lugar;

class RutaController extends Controller
{/*
    public function welcome(Request $request)
    {
        $tipos = Tipo::all();
        $lugares = Lugar::all();
        $rutas = Ruta::query();

        if($request->tipos) {
            $rutas->whereHas('tipos', function($query) use ($request) {
                $query->where('id', $request->tipos);
            });
        }

        if($request->lugar_id) {
            $rutas->where('lugar_id', $request->lugar);
        }
        return view('welcome');
    }*/
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rutas = Ruta::all();
        $lugares = Lugar::all();
        return view('rutas', ['rutas' => $rutas, 'lugares' => $lugares]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lugares = Lugar::all();
        return view('create', ['lugares' => $lugares]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'km' => 'required|numeric|min:0',
            'desnivel' => 'required|integer|min:0',
            'descripcion' => 'required',
            'lugar_id' => 'required|exists:lugar,id',
            'tipo_ruta' => 'required|in:turismo,senderismo',
            'dificultad' => 'required|in:muy_facil,facil,intermedio,dificil,muy_dificil',
            'imagen_principal' => 'nullable|image',
        ]);

        $imagen = null;
        if ($request->hasFile('imagen_principal')) {
            $imagen = $request->file('imagen_principal')->store('rutas', 'public');
        }

        Ruta::create([
            'lugar_id' => $request->lugar_id,
            'nombre' => $request->nombre,
            'km' => $request->km,
            'desnivel' => $request->desnivel,
            'descripcion' => $request->descripcion,
            'tipo_ruta' => $request->tipo_ruta,
            'dificultad' => $request->dificultad,
            'imagen' => $imagen,
        ]);

        return redirect('/rutas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ruta = Ruta::with(['imagenes', 'valoraciones'])->find($id);

        return view('ruta', ['ruta' => $ruta]);
    }

    /**
     * Show the form for editing the specified resource.
     */
        public function edit(string $id)
        {
            $ruta = Ruta::find($id);
            $tipos = Tipo::all();
            $lugares = Lugar::all();

            return view('rutas.edit', ['ruta' => $ruta, 'tipos' => $tipos, 'lugares' => $lugares]);
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
