@extends('base')

@section('contenido')
<div class="container mt-5 user-profile">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-3 perfil-titulo">Mi Perfil</h1>
            <div class="card perfil-card shadow-sm">
                <div class="card-body perfil-card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="perfil-avatar-card">
                                <div class="perfil-avatar-circle">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                <p class="perfil-nombre mb-1">{{ $user->name }}</p>
                                <p class="perfil-subtitle mb-0">Usuario registrado</p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <dl class="row mb-0 perfil-detalles">
                                <dt class="col-sm-4 perfil-detalle-label">Nombre</dt>
                                <dd class="col-sm-8 perfil-detalle-valor">{{ $user->name }}</dd>

                                <dt class="col-sm-4 perfil-detalle-label">Email</dt>
                                <dd class="col-sm-8 perfil-detalle-valor">{{ $user->email }}</dd>

                                <dt class="col-sm-4 perfil-detalle-label">Creado</dt>
                                <dd class="col-sm-8 perfil-detalle-valor">{{ optional($user->created_at)->format('d/m/Y') ?? 'No disponible' }}</dd>

                                <dt class="col-sm-4 perfil-detalle-label">Rutas añadidas</dt>
                                <dd class="col-sm-8 perfil-detalle-valor">{{ $rutas->count() }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h2 class="perfil-subtitulo">Mis rutas añadidas</h2>
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-profile-edit">Editar perfil</a>
        </div>
    </div>

    @if($rutas->isEmpty())
        <div class="alert alert-info perfil-empty-alert">
            No tienes rutas añadidas todavía. Navega el catálogo de rutas y añádelas a favoritos para encontrarlas aquí.
        </div>
    @else
        <div class="row">
            @foreach($rutas as $ruta)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card perfil-ruta-card h-100">
                        <img
                            src="{{ $ruta->imagen ? asset('storage/' . $ruta->imagen) : 'https://via.placeholder.com/400x250?text=' . urlencode($ruta->nombre) }}"
                            class="card-img-top perfil-ruta-img"
                            alt="{{ $ruta->nombre }}"
                        >
                        <div class="card-body d-flex flex-column perfil-ruta-body">
                            <h5 class="card-title perfil-ruta-titulo">{{ $ruta->nombre }}</h5>
                            <p class="card-text perfil-ruta-meta"><strong>📍 Lugar:</strong> {{ $ruta->lugar->lugar ?? 'No especificado' }}</p>
                            <p class="card-text perfil-ruta-meta"><strong>📏 Distancia:</strong> {{ number_format($ruta->km, 2) }} km</p>
                            <p class="card-text perfil-ruta-meta"><strong>⛰️ Dificultad:</strong>
                                {{ match($ruta->dificultad) {
                                    'muy_facil' => 'Muy Fácil',
                                    'facil' => 'Fácil',
                                    'intermedio' => 'Intermedio',
                                    'dificil' => 'Difícil',
                                    'muy_dificil' => 'Muy Difícil',
                                    default => ucfirst(str_replace('_', ' ', $ruta->dificultad)),
                                } }}
                            </p>
                            <p class="text-muted mb-3 perfil-ruta-descripcion">{{ Str::limit($ruta->descripcion, 90) }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('rutas.show', $ruta->id) }}" class="btn btn-primary w-100 btn-ver-ruta">
                                    Ver ruta
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
