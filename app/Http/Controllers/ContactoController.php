<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
    /**
     * Procesa el formulario de contacto.
     */
    public function enviar(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mensaje' => 'required|string|max:2000',
        ]);

        return redirect()->route('contacto')
            ->with('status', 'Mensaje enviado correctamente. Gracias por contactar.');
    }
}
