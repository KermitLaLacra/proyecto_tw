<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\LugarController;
use App\Http\Controllers\ImagenRutaController;
use App\Http\Controllers\ValoracionController;
use App\Http\Controllers\FavoritoController;
use App\Models\Ruta;
use App\Models\Tipo;
use App\Models\Lugar;

Route::get('/', function () {
    $lugares = Lugar::all();
    $km_max = Ruta::max('km') ?? 100;
    $desnivel_max = Ruta::max('desnivel') ?? 1000;
    return view('welcome', [
        'lugares' => $lugares,
        'km_max' => $km_max,
        'desnivel_max' => $desnivel_max
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/mis-favoritos', [FavoritoController::class, 'index'])->name('favoritos.index');
    Route::post('/ruta/{ruta}/favorito', [FavoritoController::class, 'toggle'])->name('favoritos.toggle');
});

Route::middleware('auth')->group(function () {
	// Route::get('/mis-favoritos', [FavoritoController::class, 'index'])->name('favoritos.index');
	// Route::post('/ruta/{ruta}/favorito', [FavoritoController::class, 'toggle'])->name('favoritos.toggle');
});

Route::resource('rutas', RutaController::class);
Route::post('/rutas/{ruta}/oficial', [RutaController::class, 'toggleOficial'])
    ->middleware('auth')
    ->name('rutas.oficial.toggle');
Route::get('/rutas', [RutaController::class, 'index'])->name('rutas.index');
Route::get('/rutas/{ruta}', [RutaController::class, 'show'])->name('rutas.show');

Route::view('/contacto', 'contacto')->name('contacto');
Route::post('/contacto/enviar', [ContactoController::class, 'enviar'])->name('contacto.enviar');

Route::resource('lugares', LugarController::class)->middleware('auth');

require __DIR__.'/auth.php';
