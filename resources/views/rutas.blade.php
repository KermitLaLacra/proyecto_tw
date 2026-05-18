<!--

VISTA DEL LISTADO DE LAS RUTAS


-->


<!DOCTYPE html>
<html lang="es">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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