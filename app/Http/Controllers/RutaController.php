<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
    public function index(Request $request)
    {
        $query = Ruta::query();
        $lugares = Lugar::all();

        // Filtro por nombre
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        // Filtro por lugar
        if ($request->filled('lugar')) {
            $query->where('lugar_id', $request->lugar);
        }

        // Filtro por tipo
        if ($request->filled('tipo')) {
            $query->where('tipo_ruta', $request->tipo);
        }

        // Filtro por dificultad
        if ($request->filled('dificultad')) {
            $query->where('dificultad', $request->dificultad);
        }

        // Filtro por km mínimo
        if ($request->filled('km_min')) {
            $query->where('km', '>=', $request->km_min);
        }

        // Filtro por km máximo
        if ($request->filled('km_max')) {
            $query->where('km', '<=', $request->km_max);
        }

        // Filtro por desnivel mínimo
        if ($request->filled('desnivel_min')) {
            $query->where('desnivel', '>=', $request->desnivel_min);
        }

        // Filtro por desnivel máximo
        if ($request->filled('desnivel_max')) {
            $query->where('desnivel', '<=', $request->desnivel_max);
        }

        // Filtro rutas oficiales
        if ($request->has('oficial') && $request->oficial == '1') {
            $query->where('es_oficial', true);
        }

        $rutas = $query->get();

        return view('rutas', [
            'rutas' => $rutas,
            'lugares' => $lugares,
            'km_max' => Ruta::max('km') ?? 100,
            'desnivel_max' => Ruta::max('desnivel') ?? 1000
        ]);
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
            'imagenes' => 'nullable|array',
            'imagenes.*' => 'image',
        ]);

        $imagen = null;
        if ($request->hasFile('imagen_principal')) {
            $imagen = $request->file('imagen_principal')->store('rutas', 'public');
        }

        $ruta = Ruta::create([
            'user_id' => auth()->id(),
            'lugar_id' => $request->lugar_id,
            'nombre' => $request->nombre,
            'km' => $request->km,
            'desnivel' => $request->desnivel,
            'descripcion' => $request->descripcion,
            'tipo_ruta' => $request->tipo_ruta,
            'dificultad' => $request->dificultad,
            'imagen' => $imagen,
            'es_oficial' => false,
        ]);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $index => $imagenAdicional) {
                $archivo = $imagenAdicional->store('rutas', 'public');
                $ruta->imagenes()->create([
                    'archivo' => $archivo,
                    'orden' => $index,
                ]);
            }
        }

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

    public function toggleOficial(Ruta $ruta)
    {
        if (! auth()->check() || ! auth()->user()->hasRole('administrador')) {
            abort(403);
        }

        $ruta->es_oficial = ! $ruta->es_oficial;
        $ruta->save();

        return back()->with('status', $ruta->es_oficial ? 'Ruta marcada como oficial.' : 'Ruta desmarcada como oficial.');
    }
}