<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruta del Alioli - Listado de Rutas</title>
    <style>
        /* Estilos básicos para la estructura */
        body { font-family: sans-serif; margin: 0; padding: 0; background-color: #f4f4f9; display: flex; flex-direction: column; min-height: 100vh; }
        header { background: #2e7d32; color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        header a { color: white; text-decoration: none; margin-left: 15px; }
        main { padding: 2rem; flex: 1; }
        footer { background: #333; color: white; text-align: center; padding: 1rem; }
        .ruta-card { background: white; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    </style>
</head>
<body>



    <!-- Incrustamos el Header directamente aquí -->
    @include('header')

    <!-- Contenido principal de la página Index -->
    <main>
        <h1>Explora las mejores rutas naturales</h1>
        <p>Descubre recorridos increíbles compartidos por nuestra comunidad. ¡Encuentra tu próxima aventura!</p>

        <!-- Contenedor del listado de rutas -->
        <div class="listado-rutas">
            
            <article class="ruta-card">
                <h3>Ruta del Cares</h3>
                <p><strong>Dificultad:</strong> Media | <strong>Distancia:</strong> 12 km</p>
                <p><em>Ruta Oficial validada por guía</em> ✅</p>
                <p>Espectacular desfiladero situado en el Parque Nacional de los Picos de Europa...</p>
                <button>Ver ficha completa</button>
            </article>

            <article class="ruta-card">
                <h3>Camino de los Siete Lagos</h3>
                <p><strong>Dificultad:</strong> Baja | <strong>Distancia:</strong> 8 km</p>
                <p>Ideal para hacer en familia. Bosques densos y lagos cristalinos...</p>
                <button>Ver ficha completa</button>
            </article>

        </div>
    </main>

    <!-- Incrustamos el Footer directamente aquí -->
    @include('footer')

</body>
</html>