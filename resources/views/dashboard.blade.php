@extends('base')

@section('contenido')
<div class="container py-5">
    
    <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
        <div>
            <h1 class="titulo-create mb-1">Mi Panel de Control</h1>
            <p class="text-muted">¡Hola, {{ auth()->user()->name }}! Aquí puedes gestionar tus aportes.</p>
        </div>
        <a href="{{ route('rutas.create') }}" class="btn btn-create btn-submit">
            + Publicar Nueva Ruta
        </a>
    </div>

    <div class="mb-4">
        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-3 py-3 px-4 shadow-sm" style="border-radius: 12px;">
            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; font-weight: 700;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <span class="fw-bold">Editar perfil</span>
        </a>
    </div>

    {{-- SECCIÓN DE RUTAS FAVORITAS --}}
    <h2 class="h4 mb-4" style="color: var(--verde-principal); font-weight: 700;">Mis Rutas Favoritas</h2>
    
    <div class="row mb-5">
        @php
            $rutasFavoritas = auth()->user()->rutasFavoritas()->with('lugar')->get();
        @endphp

        @forelse($rutasFavoritas as $ruta)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0" style="border-bottom: 4px solid gold;">
                    <div class="position-relative">
                        <img 
                            src="{{ $ruta->imagen ? asset('storage/' . $ruta->imagen) : 'https://via.placeholder.com/400x250?text=' . urlencode($ruta->nombre) }}" 
                            class="card-img-top" 
                            alt="{{ $ruta->nombre }}"
                            style="height: 200px; object-fit: cover;"
                        >
                        <div style="position: absolute; top: 8px; right: 8px;">
                            <form method="POST" action="{{ route('favoritos.toggle', $ruta->id) }}">
                                @csrf
                                <button type="submit" class="btn p-1 border-0" style="background: rgba(255,255,255,0.85); border-radius: 999px;">
                                    <span style="color: gold; font-size: 2rem; line-height: 1;">★</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        <h4 class="card-title fw-bold">{{ $ruta->nombre }}</h4>
                        <p class="card-text mb-1">
                            <strong>📍 Lugar:</strong> {{ $ruta->lugar->lugar ?? 'No especificado' }}
                        </p>
                        <p class="card-text mb-1">
                            <strong>📏 Distancia:</strong> {{ number_format($ruta->km, 2) }} km
                        </p>
                        <p class="card-text">
                            <strong>⛰️ Dificultad:</strong> 
                            <span class="badge badge-dificultad-{{ str_replace('_', '-', $ruta->dificultad) }}">
                                {{ ucfirst(str_replace('_', ' ', $ruta->dificultad)) }}
                            </span>
                        </p>
                    </div>

                    <div class="card-footer bg-white border-0 pb-3">
                        <a href="{{ route('rutas.show', $ruta->id) }}" class="btn btn-outline-primary w-100 fw-bold">
                            Ver detalles
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    <p class="mb-0">Aún no has marcado ninguna ruta como favorita. ¡Explora el catálogo y añade tus rutas preferidas!</p>
                </div>
            </div>
        @endforelse
    </div>

    <h2 class="h4 mb-4" style="color: var(--verde-principal); font-weight: 700;">Mis Rutas Publicadas</h2>

    <div class="row">
        @php
            // Consultamos directamente las rutas que pertenecen al usuario logueado
            $misRutas = \App\Models\Ruta::where('user_id', auth()->id())->get();
        @endphp

        @forelse($misRutas as $ruta)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0" style="border-bottom: 4px solid var(--verde-principal);">
                    
                    <img 
                        src="{{ $ruta->imagen ? asset('storage/' . $ruta->imagen) : 'https://via.placeholder.com/400x250?text=' . urlencode($ruta->nombre) }}" 
                        class="card-img-top" 
                        alt="{{ $ruta->nombre }}"
                        style="height: 200px; object-fit: cover;"
                    >

                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h4 class="card-title text-success fw-bold mb-0">{{ $ruta->nombre }}</h4>
                            @if($ruta->es_oficial)
                                <span class="badge bg-success">Oficial</span>
                            @endif
                        </div>
                        
                        <p class="card-text mb-1">
                            <strong>📏 Distancia:</strong> {{ number_format($ruta->km, 2) }} km
                        </p>
                        <p class="card-text mb-1">
                            <strong>🧭 Tipo:</strong> 
                            <span class="badge badge-tipo-{{ $ruta->tipo_ruta }}">
                                {{ ucfirst($ruta->tipo_ruta) }}
                            </span>
                        </p>
                        <p class="card-text">
                            <strong>⛰️ Dificultad:</strong> 
                            <span class="badge badge-dificultad-{{ str_replace('_', '-', $ruta->dificultad) }}">
                                {{ ucfirst(str_replace('_', ' ', $ruta->dificultad)) }}
                            </span>
                        </p>
                    </div>

                    <div class="card-footer bg-white border-0 pb-4">
                        <div class="d-flex gap-2">
                            <a href="{{ route('rutas.show', $ruta->id) }}" class="btn btn-outline-secondary w-100 fw-bold">
                                Ver
                            </a>
                            
                            <a href="{{ route('rutas.edit', $ruta->id) }}" class="btn btn-create w-100 text-white" style="background-color: var(--verde-principal);">
                                Editar
                            </a>
                        </div>

                        @if(auth()->user()->hasRole('administrador'))
                            <div class="mt-2">
                                <form action="{{ route('rutas.oficial.toggle', $ruta->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary w-100 fw-bold">
                                        {{ $ruta->es_oficial ? 'Quitar oficial' : 'Marcar oficial' }}
                                    </button>
                                </form>
                            </div>
                        @endif
                        
                        <div class="mt-2">
                            <form action="{{ route('rutas.destroy', $ruta->id) }}" method="POST" class="m-0" onsubmit="return confirm('¿Estás totalmente seguro de que quieres borrar esta ruta? Esta acción no se puede deshacer.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100 fw-bold">
                                    Eliminar Ruta
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card card-create border-0 text-center py-5 shadow-sm">
                    <div class="card-body py-5">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">🏞️</div>
                        <h3 class="fw-bold" style="color: var(--verde-principal);">Aún no has publicado ninguna ruta</h3>
                        <p class="text-muted mb-4">¡Anímate y comparte tu primer sendero con la comunidad de SenderoGuía!</p>
                        <a href="{{ route('rutas.create') }}" class="btn btn-create btn-submit px-4 py-2">
                            Crear mi primera ruta
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection