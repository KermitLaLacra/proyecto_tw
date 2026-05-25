@extends('base')

@section('contenido')
<div class="container mt-5 ruta-detalle">
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Sección de imágenes -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="ruta-images-carousel">
                @if($ruta->imagenes && $ruta->imagenes->count() > 0)
                    <div id="rutaCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($ruta->imagenes as $index => $imagen)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img
                                        src="{{ asset('storage/' . $imagen->ruta) }}"
                                        class="d-block w-100"
                                        alt="Imagen de {{ $ruta->nombre }}"
                                        style="height: 500px; object-fit: cover;"
                                    >
                                </div>
                            @endforeach
                        </div>
                        @if($ruta->imagenes->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#rutaCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Anterior</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#rutaCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Siguiente</span>
                            </button>
                        @endif
                    </div>
                @elseif($ruta->imagen)
                    <img
                        src="{{ asset('storage/' . $ruta->imagen) }}"
                        class="w-100"
                        alt="{{ $ruta->nombre }}"
                        style="height: 500px; object-fit: cover; border-radius: 8px;"
                    >
                @else
                    <img
                        src="https://via.placeholder.com/800x500?text={{ urlencode($ruta->nombre) }}"
                        class="w-100"
                        alt="{{ $ruta->nombre }}"
                        style="height: 500px; object-fit: cover; border-radius: 8px;"
                    >
                @endif
            </div>
        </div>
    </div>

    <!-- Nombre de la ruta -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="ruta-titulo">
                {{ $ruta->nombre }}
                @if($ruta->es_oficial)
                    <span class="badge bg-success text-warning" style="font-size: 0.75rem; vertical-align: middle;">Oficial</span>
                @endif

                @if(auth()->check() && auth()->user()->hasRole('administrador'))
                    <form method="POST" action="{{ route('rutas.oficial.toggle', $ruta->id) }}" class="d-inline ms-2">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light text-dark" style="border-radius: 999px; padding: .35rem .75rem;">
                            {{ $ruta->es_oficial ? 'Quitar oficial' : 'Marcar oficial' }}
                        </button>
                    </form>
                @endif

                {{-- Estrella de favorito al lado de la etiqueta Oficial --}}
                <span style="margin-left: .5rem;">
                    @if(auth()->check())
                        <form method="POST" action="{{ route('favoritos.toggle', $ruta->id) }}" style="display: inline-block">
                            @csrf
                            <button type="submit" class="btn p-0 border-0 align-baseline" style="background: transparent;">
                                @if(auth()->user()->rutasFavoritas->contains($ruta->id))
                                    <span style="color: gold; font-size: 1.75rem;">★</span>
                                @else
                                    <span style="color: #cccccc; font-size: 1.75rem;">☆</span>
                                @endif
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-decoration-none">
                            <span style="color: #cccccc; font-size: 1.75rem;">☆</span>
                        </a>
                    @endif
                </span>
            </h1>
        </div>
    </div>

    <!-- Detalles en una fila -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="ruta-detalles">
                <div class="detalle-item">
                    <span class="detalle-label">📏 Distancia</span>
                    <span class="detalle-valor">{{ number_format($ruta->km, 2) }} km</span>
                </div>
                <div class="detalle-separador"></div>
                <div class="detalle-item">
                    <span class="detalle-label">⛰️ Desnivel</span>
                    <span class="detalle-valor">{{ $ruta->desnivel }} m</span>
                </div>
                <div class="detalle-separador"></div>
                <div class="detalle-item">
                    <span class="detalle-label">🧭 Tipo</span>
                    <span class="detalle-valor">
                        <span class="badge badge-tipo-{{ $ruta->tipo_ruta }}">
                            {{ ucfirst(str_replace('_', ' ', $ruta->tipo_ruta)) }}
                        </span>
                    </span>
                </div>
                <div class="detalle-separador"></div>
                <div class="detalle-item">
                    <span class="detalle-label">⛰️ Dificultad</span>
                    <span class="detalle-valor">
                        <span class="badge badge-dificultad-{{ str_replace('_', '-', $ruta->dificultad) }}">
                            {{ match($ruta->dificultad) {
                                'muy_facil' => 'Muy Fácil',
                                'facil' => 'Fácil',
                                'intermedio' => 'Intermedio',
                                'dificil' => 'Difícil',
                                'muy_dificil' => 'Muy Difícil',
                                default => $ruta->dificultad
                            } }}
                        </span>
                    </span>
                </div>
                <div class="detalle-separador"></div>
                <div class="detalle-item">
                    <span class="detalle-label">📍 Lugar</span>
                    <span class="detalle-valor">{{ $ruta->lugar->lugar ?? 'No especificado' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Descripción -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="ruta-descripcion">
                <h3 class="descripcion-titulo">Descripción</h3>
                <p class="descripcion-texto">{{ $ruta->descripcion }}</p>
            </div>
        </div>
    </div>

    <!-- Sección de valoraciones -->
    <div class="row">
        <div class="col-12">
            <div class="ruta-valoraciones">
                <h3 class="valoraciones-titulo">Valoraciones</h3>

                @if($ruta->valoraciones && $ruta->valoraciones->count() > 0)
                    <div class="valoraciones-lista">
                        @foreach($ruta->valoraciones as $valoracion)
                            <div class="valoracion-item">
                                <div class="valoracion-header">
                                    <div class="valoracion-puntuacion">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="estrella {{ $i <= $valoracion->puntuacion ? 'llena' : 'vacia' }}">★</span>
                                        @endfor
                                    </div>
                                    <span class="valoracion-usuario">{{ $valoracion->usuario ?? 'Anónimo' }}</span>
                                </div>
                                <p class="valoracion-comentario">{{ $valoracion->comentario }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info" role="alert">
                        <p>Aún no hay valoraciones para esta ruta. ¡Sé el primero en valorarla!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Botón para volver -->
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <a href="{{ route('rutas.index') }}" class="btn btn-outline-secondary">
                ← Volver al listado
            </a>
        </div>
    </div>
</div>
@endsection
