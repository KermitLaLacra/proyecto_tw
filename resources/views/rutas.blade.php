@extends('base')

@section('contenido')
<div class="container mt-5">
    <h1 class="mb-5">Nuestras Mejores Rutas</h1>

    <!-- SECCIÓN DE FILTROS -->
    <div class="mb-5">
        <form method="GET" action="{{ route('rutas.index') }}" id="filtrosForm">
            <!-- BARRA DE BÚSQUEDA POR NOMBRE -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card card-search-bar">
                        <div class="card-body p-0">
                            <input 
                                type="text" 
                                class="form-control form-control-lg search-input" 
                                id="nombre" 
                                name="nombre" 
                                placeholder="🔍 Buscar ruta por nombre..."
                                value="{{ request('nombre') }}"
                            >
                        </div>
                    </div>
                </div>
            </div>

            <!-- FILTROS SECUNDARIOS -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-filters">
                        <div class="card-body">
                            <div class="row g-2 align-items-end">
                                <!-- Filtro por Lugar -->
                                <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                                    <label for="lugar" class="form-label">Lugar</label>
                                    <select class="form-select" id="lugar" name="lugar">
                                        <option value="">Todos</option>
                                        @foreach($lugares as $lugar)
                                            <option value="{{ $lugar->id }}" {{ request('lugar') == $lugar->id ? 'selected' : '' }}>
                                                {{ $lugar->lugar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Filtro por Tipo -->
                                <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                                    <label for="tipo" class="form-label">Tipo</label>
                                    <select class="form-select" id="tipo" name="tipo">
                                        <option value="">Todos</option>
                                        <option value="turismo" {{ request('tipo') === 'turismo' ? 'selected' : '' }}>Turismo</option>
                                        <option value="senderismo" {{ request('tipo') === 'senderismo' ? 'selected' : '' }}>Senderismo</option>
                                    </select>
                                </div>

                                <!-- Filtro por Dificultad -->
                                <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                                    <label for="dificultad" class="form-label">Dificultad</label>
                                    <select class="form-select" id="dificultad" name="dificultad">
                                        <option value="">Todas</option>
                                        <option value="muy_facil" {{ request('dificultad') === 'muy_facil' ? 'selected' : '' }}>Muy Fácil</option>
                                        <option value="facil" {{ request('dificultad') === 'facil' ? 'selected' : '' }}>Fácil</option>
                                        <option value="intermedio" {{ request('dificultad') === 'intermedio' ? 'selected' : '' }}>Intermedio</option>
                                        <option value="dificil" {{ request('dificultad') === 'dificil' ? 'selected' : '' }}>Difícil</option>
                                        <option value="muy_dificil" {{ request('dificultad') === 'muy_dificil' ? 'selected' : '' }}>Muy Difícil</option>
                                    </select>
                                </div>

                                <!-- Filtro por Longitud mínima -->
                                <div class="col-12 col-sm-6 col-md-2 col-lg-2">
                                    <label for="km_min" class="form-label">Km mín.</label>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        id="km_min" 
                                        name="km_min" 
                                        placeholder="0"
                                        step="0.1"
                                        value="{{ request('km_min') }}"
                                    >
                                </div>

                                <!-- Filtro por Longitud máxima -->
                                <div class="col-12 col-sm-6 col-md-2 col-lg-2">
                                    <label for="km_max" class="form-label">Km máx.</label>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        id="km_max" 
                                        name="km_max" 
                                        placeholder="999"
                                        step="0.1"
                                        value="{{ request('km_max') }}"
                                    >
                                </div>

                                <!-- Botones de acción -->
                                <div class="col-12 col-lg-2 d-flex gap-2">
                                    <button type="submit" class="btn btn-success flex-grow-1 btn-filter">
                                        🔍 Buscar
                                    </button>
                                    <a href="{{ route('rutas.index') }}" class="btn btn-outline-secondary btn-filter">
                                        🔄
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- SECCIÓN DE LISTADO DE RUTAS -->
    <div class="row">
        @forelse($rutas as $ruta)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <!-- Imagen de la ruta -->
                    <img 
                        src="{{ $ruta->imagen ?? 'https://via.placeholder.com/400x250?text=' . urlencode($ruta->nombre) }}" 
                        class="card-img-top" 
                        alt="{{ $ruta->nombre }}"
                        style="height: 250px; object-fit: cover;"
                    >

                    <div class="card-body">
                        <!-- Nombre de la ruta -->
                        <h4 class="card-title">
                            {{ $ruta->nombre }}
                            @if($ruta->es_oficial)
                                <span class="badge bg-success text-warning" style="font-size: 0.75rem; vertical-align: middle;">Oficial</span>
                            @endif
                        </h4>

                        <!-- Ubicación -->
                        <p class="card-text">
                            <strong>📍 Ubicación:</strong> {{ $ruta->lugar->lugar }}
                        </p>

                        <!-- Tipo -->
                        <p class="card-text">
                            <strong>🧭 Tipo:</strong> 
                            <span class="badge badge-tipo-{{ $ruta->tipo_ruta }}">
                                {{ ucfirst($ruta->tipo_ruta) }}
                            </span>
                        </p>

                        <!-- Distancia -->
                        <p class="card-text">
                            <strong>📏 Distancia:</strong> {{ number_format($ruta->km, 2) }} km
                        </p>

                        <!-- Desnivel -->
                        <p class="card-text">
                            <strong>⛰️ Desnivel:</strong> {{ $ruta->desnivel }} m
                        </p>

                        <!-- Dificultad -->
                        <p class="card-text">
                            <strong>⛰️ Dificultad:</strong> 
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
                        </p>

                        <!-- Descripción -->
                        <p class="card-text text-muted">
                            {{ Str::limit($ruta->descripcion, 100) }}
                        </p>
                    </div>

                    <div class="card-footer bg-white">
                        <a href="{{ route('rutas.show', $ruta->id) }}" class="btn btn-primary w-100">
                            Ver detalles
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading">No hay rutas disponibles</h4>
                    <p>Intenta ajustar los filtros de búsqueda para encontrar las rutas que deseas.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection