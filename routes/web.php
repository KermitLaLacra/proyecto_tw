<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\LugarController;
use App\Http\Controllers\ImagenRutaController;
use App\Http\Controllers\ValoracionController;
use App\Models\Ruta;
use App\Models\Tipo;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
		Route::get('/mis-favoritos', [FavoritoController::class, 'index'])->name('favoritos.index');
		Route::post('/ruta/{ruta}/favorito', [FavoritoController::class, 'toggle'])->name('favoritos.toggle');
});

Route::resource('rutas', RutaController::class);

Route::resource('tipos', TipoController::class);

Route::resource('lugares', LugarController::class);

Route::resource('imagenes', ImagenRutaController::class);

Route::resource('valoraciones', ValoracionController::class);


require __DIR__.'/auth.php';
