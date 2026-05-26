<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Lugar;
use App\Models\Ruta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear 3 usuarios de prueba diferentes con sus credenciales particulares
        $user1 = User::firstOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'password' => bcrypt('password'),
        ]);

        $user2 = User::firstOrCreate([
            'email' => 'juan@example.com',
        ], [
            'name' => 'Juan Guía',
            'password' => bcrypt('password'),
        ]);

        $user3 = User::firstOrCreate([
            'email' => 'maria@example.com',
        ], [
            'name' => 'María Senderos',
            'password' => bcrypt('password'),
        ]);

        // Crear roles con Spatie
        $rolUsuario = Role::firstOrCreate(['name' => 'usuario']);
        $rolAdmin = Role::firstOrCreate(['name' => 'administrador']);

        $user1->assignRole($rolAdmin);
        $user2->assignRole($rolUsuario);
        $user3->assignRole($rolUsuario);

        // 2. Crear 5 lugares (municipios de Granada)
        $lugares = [
            ['lugar' => 'Granada'],
            ['lugar' => 'Motril'],
            ['lugar' => 'Loja'],
            ['lugar' => 'Guadix'],
            ['lugar' => 'Alhama de Granada'],
            ['lugar' => 'La Alpujarra'],
        ];

        $lugaresCreados = collect($lugares)->map(fn($lugar) => Lugar::create($lugar));

        // 3. Crear 3 rutas al usuario administrador
        $this->crearRutaConImagenes([
            'nombre' => 'Ruta de las Alpujarras',
        ], [
            'user_id' => $user1->id,
            'km' => 25.50,
            'desnivel' => 850,
            'es_oficial' => false,
            'descripcion' => 'Una hermosa ruta que recorre los pueblos blancos de las Alpujarras con vistas espectaculares de las montañas.',
            'imagen' => null,
            'tipo_ruta' => 'turismo',
            'dificultad' => 'intermedio',
            'lugar_id' => $lugaresCreados[5]->id,
        ], 'alpujarra.jpg');

        $this->crearRutaConImagenes([
            'nombre' => 'Senderismo Sierra Nevada',
        ], [
            'user_id' => $user2->id,
            'km' => 15.75,
            'desnivel' => 1200,
            'es_oficial' => true,
            'descripcion' => 'Ruta de senderismo por los picos de Sierra Nevada, ideal para amantes de la naturaleza y el trekking.',
            'imagen' => null,
            'tipo_ruta' => 'senderismo',
            'dificultad' => 'dificil',
            'lugar_id' => $lugaresCreados[0]->id,
        ], 'sierra_nevada.jpg');

        $this->crearRutaConImagenes([
            'nombre' => 'Paseo Loja',
        ], [
            'user_id' => $user3->id,
            'km' => 8.30,
            'desnivel' => 120,
            'es_oficial' => false,
            'descripcion' => 'Agradable paseo perfecto para familias.',
            'imagen' => null,
            'tipo_ruta' => 'turismo',
            'dificultad' => 'muy_facil',
            'lugar_id' => $lugaresCreados[2]->id,
        ], 'loja.avif');
    }

    private function crearRutaConImagenes(array $busqueda, array $datos, ?string $imagenPrincipal = null, array $imagenesAdicionales = []): Ruta
    {
        if (! Storage::disk('public')->exists('rutas')) {
            Storage::disk('public')->makeDirectory('rutas');
        }

        $ruta = Ruta::firstOrCreate($busqueda, $datos);

        if ($imagenPrincipal && ! $ruta->imagen) {
            $ruta->imagen = $this->copiarImagenDeSeeder($imagenPrincipal);
            $ruta->save();
            if ($ruta->imagen) {
                $ruta->imagenes()->firstOrCreate([
                    'archivo' => $ruta->imagen,
                ], [
                    'orden' => 0,
                ]);
            }
        }

        foreach ($imagenesAdicionales as $index => $archivo) {
            $destino = $this->copiarImagenDeSeeder($archivo);
            if ($destino) {
                $ruta->imagenes()->firstOrCreate([
                    'archivo' => $destino,
                ], [
                    'orden' => $index + 1,
                ]);
            }
        }

        return $ruta;
    }

    private function copiarImagenDeSeeder(string $archivo): string
    {
        $origen = base_path('media/' . $archivo);

        if (! file_exists($origen)) {
            return '';
        }

        return Storage::disk('public')->putFileAs('rutas', new File($origen), basename($archivo));
    }
}
