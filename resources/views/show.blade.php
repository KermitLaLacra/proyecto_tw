<!--

VISTA PARA MOSTRAR LOS DETALLES DE UNA RUTA

-->

@include('header')
    <h1>{{ $ruta->nombre }}</h1>
    
    <p>{{ $ruta->imagen }}</p>

    <p>Distancia: {{ $ruta->km }}</p>

    <p>{{ $ruta->descripcion }}</p>
@include('footer')