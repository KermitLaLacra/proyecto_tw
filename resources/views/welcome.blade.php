@extends('base')

@section('contenido')
<div class="container mt-5">
    <div class="row align-items-center hero-welcome">
        <div class="col-12 text-center">
            <h1 class="display-3 fw-bold mb-4 titulo-welcome">
                Ruta del Alioli
            </h1>
            <p class="lead text-muted mb-5">
                Descubre las mejores rutas para explorar nuestro territorio
            </p>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-12">
            <form method="GET" action="{{ route('rutas.index') }}" id="filtrosForm">
                
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card card-search-bar shadow-sm">
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

                <div class="row">
                    <div class="col-12">
                        <div class="card card-filters shadow-sm">
                            <div class="card-body">
                                <div class="row g-2 align-items-end">
                                    
                                    <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                                        <label for="lugar" class="form-label">Lugar</label>
                                        <select class="form-select" id="lugar" name="lugar">
                                            <option value="">Todos</option>
                                            @if(isset($lugares) && $lugares->count())
                                                @foreach($lugares as $lugar)
                                                    <option value="{{ $lugar->id }}" {{ request('lugar') == $lugar->id ? 'selected' : '' }}>
                                                        {{ $lugar->lugar }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                                        <label for="tipo" class="form-label">Tipo</label>
                                        <select class="form-select" id="tipo" name="tipo">
                                            <option value="">Todos</option>
                                            <option value="turismo" {{ request('tipo') === 'turismo' ? 'selected' : '' }}>Turismo</option>
                                            <option value="senderismo" {{ request('tipo') === 'senderismo' ? 'selected' : '' }}>Senderismo</option>
                                        </select>
                                    </div>

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

                                    <div class="col-12 col-sm-6 col-md-2 col-lg-1">
                                        <label for="km_min" class="form-label">Km mín.</label>
                                        <input type="number" class="form-control" id="km_min" name="km_min" placeholder="0" step="0.1" value="{{ request('km_min') }}">
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-2 col-lg-1">
                                        <label for="km_max" class="form-label">Km máx.</label>
                                        <input type="number" class="form-control" id="km_max" name="km_max" placeholder="{{ number_format($km_max ?? 100, 1) }}" step="0.1" max="{{ $km_max ?? 100 }}" value="{{ request('km_max') }}">
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-2 col-lg-1">
                                        <label for="desnivel_min" class="form-label">Desn. mín.</label>
                                        <input type="number" class="form-control" id="desnivel_min" name="desnivel_min" placeholder="0" step="1" min="0" max="{{ $desnivel_max ?? 1000 }}" value="{{ request('desnivel_min') }}">
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-2 col-lg-1">
                                        <label for="desnivel_max" class="form-label">Desn. máx.</label>
                                        <input type="number" class="form-control" id="desnivel_max" name="desnivel_max" placeholder="{{ number_format($desnivel_max ?? 1000, 0) }}" step="1" max="{{ $desnivel_max ?? 1000 }}" value="{{ request('desnivel_max') }}">
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 pb-1">
                                        <div class="form-check form-switch fs-6">
                                            <input class="form-check-input" type="checkbox" role="switch" id="oficial_welcome" name="oficial" value="1" {{ request('oficial') ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold text-success" for="oficial_welcome">Solo Oficiales</label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-12 d-flex gap-2 mt-3">
                                        <button type="submit" class="btn btn-success flex-grow-1 btn-filter">
                                            🔍 Buscar Rutas
                                        </button>
                                        <a href="/" class="btn btn-outline-secondary btn-filter" title="Limpiar filtros">
                                            Limpiar
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-12 text-center">
            <p class="text-muted small">
                <em>Completa los filtros que desees o haz clic en "Buscar Rutas" para ver todas las rutas disponibles</em>
            </p>
        </div>
    </div>
</div>
@endsection