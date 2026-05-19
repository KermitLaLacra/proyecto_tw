@extends('base')

@section('contenido')
<div class="container mt-5">
    <h1 class="mb-5">Nuestras Mejores Rutas</h1>

    <!-- SECCIÓN DE FILTROS -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Filtrar Rutas</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('rutas.index') }}" id="filtrosForm">
                        <div class="row g-3">
                            <!-- Búsqueda por nombre -->
                            <div class="col-md-6 col-lg-3">
                                <label for="nombre" class="form-label">Buscar por nombre</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="nombre" 
                                    name="nombre" 
                                    placeholder="Ej: Alpujarras"
                                    value="{{ request('nombre') }}"
                                >
                            </div>

                            <!-- Filtro por Lugar -->
                            <div class="col-md-6 col-lg-3">
                                <label for="lugar" class="form-label">Lugar</label>
                                <select class="form-select" id="lugar" name="lugar">
                                    <option value="">Todos los lugares</option>
                                    @foreach($lugares as $lugar)
                                        <option value="{{ $lugar->id }}" {{ request('lugar') == $lugar->id ? 'selected' : '' }}>
                                            {{ $lugar->lugar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filtro por Tipo -->
                            <div class="col-md-6 col-lg-3">
                                <label for="tipo" class="form-label">Tipo de Ruta</label>
                                <select class="form-select" id="tipo" name="tipo">
                                    <option value="">Todos los tipos</option>
                                    <option value="turismo" {{ request('tipo') === 'turismo' ? 'selected' : '' }}>Turismo</option>
                                    <option value="senderismo" {{ request('tipo') === 'senderismo' ? 'selected' : '' }}>Senderismo</option>
                                </select>
                            </div>

                            <!-- Filtro por Dificultad -->
                            <div class="col-md-6 col-lg-3">
                                <label for="dificultad" class="form-label">Dificultad</label>
                                <select class="form-select" id="dificultad" name="dificultad">
                                    <option value="">Todas las dificultades</option>
                                    <option value="muy_facil" {{ request('dificultad') === 'muy_facil' ? 'selected' : '' }}>Muy Fácil</option>
                                    <option value="facil" {{ request('dificultad') === 'facil' ? 'selected' : '' }}>Fácil</option>
                                    <option value="intermedio" {{ request('dificultad') === 'intermedio' ? 'selected' : '' }}>Intermedio</option>
                                    <option value="dificil" {{ request('dificultad') === 'dificil' ? 'selected' : '' }}>Difícil</option>
                                    <option value="muy_dificil" {{ request('dificultad') === 'muy_dificil' ? 'selected' : '' }}>Muy Difícil</option>
                                </select>
                            </div>

                            <!-- Filtro por Longitud (Rango) -->
                            <div class="col-md-6 col-lg-3">
                                <label for="km_min" class="form-label">Longitud mínima (km)</label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    id="km_min" 
                                    name="km_min" 
                                    placeholder="Ej: 5"
                                    step="0.1"
                                    value="{{ request('km_min') }}"
                                >
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label for="km_max" class="form-label">Longitud máxima (km)</label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    id="km_max" 
                                    name="km_max" 
                                    placeholder="Ej: 50"
                                    step="0.1"
                                    value="{{ request('km_max') }}"
                                >
                            </div>

                            <!-- Botones de acción -->
                            <div class="col-12 d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    🔍 Buscar
                                </button>
                                <a href="{{ route('rutas.index') }}" class="btn btn-secondary">
                                    🔄 Limpiar filtros
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                        <h4 class="card-title">{{ $ruta->nombre }}</h4>

                        <!-- Ubicación -->
                        <p class="card-text">
                            <strong>📍 Ubicación:</strong> {{ $ruta->lugar->lugar }}
                        </p>

                        <!-- Tipo -->
                        <p class="card-text">
                            <strong>🧭 Tipo:</strong> 
                            <span class="badge bg-info">
                                {{ ucfirst($ruta->tipo_ruta) }}
                            </span>
                        </p>

                        <!-- Distancia -->
                        <p class="card-text">
                            <strong>📏 Distancia:</strong> {{ number_format($ruta->km, 2) }} km
                        </p>

                        <!-- Dificultad -->
                        <p class="card-text">
                            <strong>⛰️ Dificultad:</strong> 
                            <span class="badge bg-warning text-dark">
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