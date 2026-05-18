<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ruta del Alioli</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    @include('header')

    <main class="container my-5">
        @yield('contenido')
    </main>

    @include('footer')

</body>
</html>