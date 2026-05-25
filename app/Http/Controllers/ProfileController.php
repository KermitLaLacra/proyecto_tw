<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Muestra el formulario para editar el perfil del usuario, pasando la información del usuario actual a la vista para que pueda ser editada.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Actualiza el perfil del usuario en la base de datos con la información proporcionada en el formulario de edición, y redirige al usuario de vuelta al formulario de edición con un mensaje de éxito si la actualización fue exitosa.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Elimina la cuenta del usuario de la base de datos después de validar que la contraseña proporcionada en el formulario de eliminación de cuenta es correcta, cierra la sesión del usuario, invalida la sesión actual y regenera el token CSRF para proteger contra ataques de falsificación de solicitudes entre sitios (CSRF), y redirige al usuario a la página de inicio después de eliminar su cuenta.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
