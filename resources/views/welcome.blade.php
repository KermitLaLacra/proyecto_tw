@extends('base')

@section('contenido')
<div class="container mt-5">
    <div class="row align-items-center" style="min-height: 300px;">
        <div class="col-12 text-center">
            <h1 class="display-3 fw-bold mb-4" style="color: #2d5a3d;">
                🥒 Ruta del Alioli
            </h1>
            <p class="lead text-muted mb-5">
                Descubre las mejores rutas para explorar nuestro territorio
            </p>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-12 col-lg-10">
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
                                    style="border: none; font-size: 1.1rem;"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card card-filters shadow-sm">
                            <div class="card-body">
                                <h5 class="mb-4">Filtrar por:</h5>
                                <div class="row g-3 align-items-end">
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                        <label for="lugar" class="form-label fw-bold">Lugar</label>
                                        <select class="form-select form-select-sm" id="lugar" name="lugar">
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

                                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                        <label for="tipo" class="form-label fw-bold">Tipo</label>
                                        <select class="form-select form-select-sm" id="tipo" name="tipo">
                                            <option value="">Todos</option>
                                            <option value="turismo" {{ request('tipo') === 'turismo' ? 'selected' : '' }}>Turismo</option>
                                            <option value="senderismo" {{ request('tipo') === 'senderismo' ? 'selected' : '' }}>Senderismo</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                        <label for="dificultad" class="form-label fw-bold">Dificultad</label>
                                        <select class="form-select form-select-sm" id="dificultad" name="dificultad">
                                            <option value="">Todas</option>
                                            <option value="muy_facil" {{ request('dificultad') === 'muy_facil' ? 'selected' : '' }}>Muy Fácil</option>
                                            <option value="facil" {{ request('dificultad') === 'facil' ? 'selected' : '' }}>Fácil</option>
                                            <option value="intermedio" {{ request('dificultad') === 'intermedio' ? 'selected' : '' }}>Intermedio</option>
                                            <option value="dificil" {{ request('dificultad') === 'dificil' ? 'selected' : '' }}>Difícil</option>
                                            <option value="muy_dificil" {{ request('dificultad') === 'muy_dificil' ? 'selected' : '' }}>Muy Difícil</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                                        <label for="km_min" class="form-label fw-bold">Km mín.</label>
                                        <input 
                                            type="number" 
                                            class="form-control form-control-sm" 
                                            id="km_min" 
                                            name="km_min" 
                                            placeholder="0"
                                            step="0.1"
                                            value="{{ request('km_min') }}"
                                        >
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                                        <label for="km_max" class="form-label fw-bold">Km máx.</label>
                                        <input 
                                            type="number" 
                                            class="form-control form-control-sm" 
                                            id="km_max" 
                                            name="km_max" 
                                            placeholder="999"
                                            step="0.1"
                                            max="{{ $km_max }}"
                                            value="{{ request('km_max') }}"
                                        >
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                                        <label for="desnivel_min" class="form-label fw-bold">Desn. mín.</label>
                                        <input 
                                            type="number" 
                                            class="form-control form-control-sm" 
                                            id="desnivel_min" 
                                            name="desnivel_min" 
                                            placeholder="0"
                                            step="1"
                                            min="0"
                                            max="{{ $desnivel_max }}"
                                            value="{{ request('desnivel_min') ?? 0 }}"
                                        >
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                                        <label for="desnivel_max" class="form-label fw-bold">Desn. máx.</label>
                                        <input 
                                            type="number" 
                                            class="form-control form-control-sm" 
                                            id="desnivel_max" 
                                            name="desnivel_max" 
                                            placeholder="999"
                                            step="1"
                                            max="{{ $desnivel_max }}"
                                            value="{{ request('desnivel_max') ?? $desnivel_max }}"
                                        >
                                    </div>
                                    <div class="col-12 col-lg-2 d-grid gap-2">
                                        <button type="submit" class="btn btn-success btn-lg" style="font-weight: 600;">
                                            🔍 Buscar
                                        </button>
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
        <div class="col-12 col-lg-10 text-center">
            <p class="text-muted small">
                💡 <em>Completa los filtros que desees o haz clic en "Buscar" para ver todas las rutas disponibles</em>
            </p>
        </div>
    </div>
</div>

<style>
    .display-3 {
        letter-spacing: -0.02em;
        text-shadow: 2px 2px 4px rgba(45, 90, 61, 0.1);
    }

    .card-search-bar {
        border: 2px solid #2d5a3d;
        border-radius: 50px;
        overflow: hidden;
    }

    .search-input {
        padding: 15px 25px !important;
    }

    .card-search-input:focus {
        border-color: #2d5a3d;
        box-shadow: 0 0 0 0.2rem rgba(45, 90, 61, 0.25);
    }

    .card-filters {
        border: 1px solid #e9ecef;
        background-color: #f8f9fa;
    }

    .form-label {
        color: #495057;
        font-size: 0.9rem;
    }

    .form-control, .form-select {
        border-color: #dee2e6;
        background-color: white;
    }

    .btn-success {
        background-color: #2d5a3d;
        border-color: #2d5a3d;
    }

    .btn-success:hover {
        background-color: #1e3f2a;
        border-color: #1e3f2a;
    }
</style>

@endsection