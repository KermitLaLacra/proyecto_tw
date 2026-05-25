@extends('base')

@section('contenido')
<style>
    .nav-pills .nav-link {
        color: var(--verde-principal);
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .nav-pills .nav-link:hover {
        background-color: rgba(46, 125, 50, 0.1);
    }
    .nav-pills .nav-link.active {
        background-color: var(--verde-principal) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(46, 125, 50, 0.2);
    }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
        <div>
            <h1 class="titulo-create mb-1">Mi Panel de Control</h1>
            <p class="text-muted">¡Hola, {{ auth()->user()->name }}! Aquí puedes gestionar tus aportes.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            @if(auth()->user()->hasRole('administrador'))
                <button type="button" class="btn fw-bold px-4" data-bs-toggle="modal" data-bs-target="#modalAddLugar" style="border: 2px solid var(--verde-principal); color: var(--verde-principal); border-radius: 4px; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='var(--verde-principal)'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--verde-principal)';">
                    📍 Añadir Lugar
                </button>
                
                <button type="button" class="btn fw-bold px-4" data-bs-toggle="modal" data-bs-target="#modalDeleteLugar" style="border: 2px solid #dc3545; color: #dc3545; border-radius: 4px; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#dc3545'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#dc3545';">
                    🗑️ Eliminar Lugar
                </button>
            @endif

            <a href="{{ route('rutas.create') }}" class="btn btn-create btn-submit">
                + Publicar Nueva Ruta
            </a>
        </div>
    </div>

    <div class="mb-5">
        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-3 py-3 px-4 shadow-sm" style="border-radius: 12px;">
            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; font-weight: 700;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <span class="fw-bold">Gestionar cuenta</span>
        </a>
    </div>

    <ul class="nav nav-pills mb-4" id="dashboardTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active px-4 py-2" id="publicadas-tab" data-bs-toggle="pill" data-bs-target="#publicadas" type="button" role="tab" aria-controls="publicadas" aria-selected="true">
                🏞️ Mis Rutas Publicadas
            </button>
        </li>
        <li class="nav-item ms-2" role="presentation">
            <button class="nav-link px-4 py-2" id="favoritas-tab" data-bs-toggle="pill" data-bs-target="#favoritas" type="button" role="tab" aria-controls="favoritas" aria-selected="false">
                ⭐ Mis Rutas Favoritas
            </button>
        </li>
    </ul>

    <div class="tab-content" id="dashboardTabsContent">
        <div class="tab-pane fade show active" id="publicadas" role="tabpanel" aria-labelledby="publicadas-tab">
            <div class="row">
                @php
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
                                <p class="text-muted mb-4">¡Anímate y comparte tu primer sendero con la comunidad!</p>
                                <a href="{{ route('rutas.create') }}" class="btn btn-create btn-submit px-4 py-2">Crear mi primera ruta</a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="tab-pane fade" id="favoritas" role="tabpanel" aria-labelledby="favoritas-tab">
            <div class="row">
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
                                <a href="{{ route('rutas.show', $ruta->id) }}" class="btn btn-outline-primary w-100 fw-bold">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info border-0 shadow-sm" role="alert" style="background-color: #f8f9fa; border-left: 4px solid gold !important;">
                            <h5 class="fw-bold mb-2 text-dark">Sin favoritos por ahora</h5>
                            <p class="mb-0 text-muted">Aún no has marcado ninguna ruta como favorita. ¡Explora el catálogo y añade tus rutas preferidas!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@if(auth()->user()->hasRole('administrador'))
    <div class="modal fade" id="modalAddLugar" tabindex="-1" aria-labelledby="modalAddLugarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 12px; overflow: hidden;">
                <div class="modal-header text-white" style="background-color: var(--verde-principal); border-bottom: none;">
                    <h5 class="modal-title fw-bold" id="modalAddLugarLabel">📍 Añadir Nuevo Lugar</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="{{ route('lugares.store') }}" method="POST" class="m-0">
                    @csrf
                    <div class="modal-body p-4">
                        <p class="text-muted small mb-4">Introduce el nombre del municipio o zona para que los usuarios puedan asociar sus rutas a este nuevo lugar.</p>
                        
                        <div class="mb-2">
                            <label for="lugar" class="form-label fw-bold" style="color: var(--verde-principal);">Nombre del lugar</label>
                            <input type="text" class="form-control" id="lugar" name="lugar" placeholder="Ej. Parque Natural, Lanjarón..." style="border: 1px solid #ddd; padding: 0.75rem; border-radius: 8px;" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Cancelar</button>
                        <button type="submit" class="btn btn-create btn-submit px-4" style="border-radius: 8px;">Guardar Lugar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
@if(auth()->user()->hasRole('administrador'))
    <div class="modal fade" id="modalDeleteLugar" tabindex="-1" aria-labelledby="modalDeleteLugarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 12px; overflow: hidden;">
                
                <div class="modal-header text-white bg-danger" style="border-bottom: none;">
                    <h5 class="modal-title fw-bold" id="modalDeleteLugarLabel">🗑️ Eliminar Lugar existente</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                @php
                    // Consultamos todos los lugares para surtir el desplegable
                    $todosLosLugares = \App\Models\Lugar::all();
                @endphp

                <form id="formEliminarLugar" action="" method="POST" class="m-0" onsubmit="const id = document.getElementById('selectLugarEliminar').value; this.action = '{{ url('/lugares') }}/' + id; return confirm('¿Estás totalmente seguro de que quieres eliminar este lugar? Esta acción podría afectar a las rutas asociadas.');">
                    @csrf
                    @method('DELETE')
                    
                    <div class="modal-body p-4">
                        <p class="text-muted small mb-4">Selecciona el lugar que deseas remover permanentemente del sistema de SenderoGuía.</p>
                        
                        <div class="mb-2">
                            <label for="selectLugarEliminar" class="form-label fw-bold text-danger">Seleccionar Ubicación</label>
                            <select class="form-select" id="selectLugarEliminar" style="border: 1px solid #ddd; padding: 0.75rem; border-radius: 8px;" required>
                                <option value="" disabled selected>Elige un lugar de la lista...</option>
                                @foreach($todosLosLugares as $lugarItem)
                                    <option value="{{ $lugarItem->id }}">{{ $lugarItem->lugar }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Cancelar</button>
                        <button type="submit" class="btn btn-danger text-white px-4" style="border-radius: 8px; font-weight: 600;">Eliminar Permanentemente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
@endsection
