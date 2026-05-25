<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Lugar;
use App\Models\Ruta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear 3 usuarios de prueba diferentes con sus credenciales particulares
        $user1 = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Juan Guía',
            'email' => 'juan@example.com',
        ]);

        $user3 = User::factory()->create([
            'name' => 'María Senderos',
            'email' => 'maria@example.com',
        ]);

        // 2. Crear 5 lugares (municipios de Granada)
        $lugares = [
            ['lugar' => 'Granada'],
            ['lugar' => 'Motril'],
            ['lugar' => 'Loja'],
            ['lugar' => 'Guadix'],
            ['lugar' => 'Alhama de Granada'],
        ];

        $lugaresCreados = collect($lugares)->map(fn($lugar) => Lugar::create($lugar));

        // 3. Crear 3 rutas asociando cada una a un usuario diferente
        Ruta::create([
            'user_id' => $user1->id, // <- Ruta asignada a Test User
            'nombre' => 'Ruta de las Alpujarras',
            'km' => 25.50,
            'desnivel' => 850,
            'es_oficial' => false,
            'descripcion' => 'Una hermosa ruta que recorre los pueblos blancos de las Alpujarras con vistas espectaculares de las montañas.',
            'imagen' => null,
            'tipo_ruta' => 'turismo',
            'dificultad' => 'intermedio',
            'lugar_id' => $lugaresCreados[0]->id,
        ]);

        Ruta::create([
            'user_id' => $user2->id, // <- Ruta asignada a Juan Guía
            'nombre' => 'Senderismo Sierra Nevada',
            'km' => 15.75,
            'desnivel' => 1200,
            'es_oficial' => true,
            'descripcion' => 'Ruta de senderismo por los picos de Sierra Nevada, ideal para amantes de la naturaleza y el trekking.',
            'imagen' => null,
            'tipo_ruta' => 'senderismo',
            'dificultad' => 'dificil',
            'lugar_id' => $lugaresCreados[1]->id,
        ]);

        Ruta::create([
            'user_id' => $user3->id, // <- Ruta asignada a María Senderos
            'nombre' => 'Paseo por la Costa Tropical',
            'km' => 8.30,
            'desnivel' => 120,
            'es_oficial' => false,
            'descripcion' => 'Agradable paseo por la costa con playas y calas escondidas. Perfecto para familias.',
            'imagen' => null,
            'tipo_ruta' => 'turismo',
            'dificultad' => 'muy_facil',
            'lugar_id' => $lugaresCreados[2]->id,
        ]);
    }
}