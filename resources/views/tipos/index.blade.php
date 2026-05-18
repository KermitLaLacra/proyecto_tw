@include('header')
    <h1>Tipos de rutas</h1>
    @foreach($tipos as $tipo)
        <p>{{ $tipo->nombre }}</p>
    @endforeach
@include('footer')