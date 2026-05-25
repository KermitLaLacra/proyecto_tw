<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lugar;

class LugarController extends Controller
{
    /**
     * Muestra una lista de todos los lugares disponibles en la base de datos.
     */
    public function index()
    {
        $lugares = Lugar::all();

        return view('lugares.index', ['lugares' => $lugares]);
    }

    /**
     * Muestra el formulario para crear un nuevo lugar.
     */
    public function create()
    {
        $rutas = Ruta::all();

        return view('create', ['rutas' => $rutas]);
    }

    /**
     * Guarda el nuevo lugar en la base de datos.
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
     * Muestra los detalles de un lugar específico, incluyendo las rutas asociadas a ese lugar.
     */
    public function show(string $id)
    {
        $lugar = Lugar::with(['rutas'])->find($id);

        return view('lugares.show', ['lugar' => $lugar]);
    }

    /**
     * Muestra el formulario para editar un lugar existente, incluyendo las rutas asociadas a ese lugar para que puedan ser modificadas.
     */
    public function edit(string $id)
    {
        $lugar = Lugar::find($id);
        $rutas = Ruta::all();

        return view('lugares.edit', ['lugar' => $lugar, 'rutas' => $rutas]);
    }

    /**
     * Actualiza el lugar en la base de datos.
     */
    public function update(Request $request, string $id)
    {
        $lugar = Lugar::find($id);

        $lugar->lugar = $request->lugar;

        $lugar->save();

        return redirect('/dashboard');
    }

    /**
     * Elimina el lugar de la base de datos.
     */
    public function destroy(string $id)
    {
        $lugar = Lugar::find($id);

        $lugar->delete();

        return redirect('/dashboard');
    }
}
