@extends('base')

@section('contenido')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card card-create border-0">
                <div class="card-body p-5">
                    <h1 class="titulo-create mb-4">✏️ Editar Ruta: {{ $ruta->nombre }}</h1>

                    <form action="{{ route('rutas.update', $ruta->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nombre" class="label-create">Nombre de la Ruta</label>
                            <input type="text" class="form-control input-create" id="nombre" name="nombre" value="{{ $ruta->nombre }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="lugar_id" class="label-create">Lugar</label>
                                <select class="form-select input-create" id="lugar_id" name="lugar_id" required>
                                    @foreach($lugares as $lugar)
                                        <option value="{{ $lugar->id }}" {{ $ruta->lugar_id == $lugar->id ? 'selected' : '' }}>
                                            {{ $lugar->lugar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="tipo_ruta" class="label-create">Tipo de Ruta</label>
                                <select class="form-select input-create" id="tipo_ruta" name="tipo_ruta" required>
                                    <option value="turismo" {{ $ruta->tipo_ruta == 'turismo' ? 'selected' : '' }}>Turismo</option>
                                    <option value="senderismo" {{ $ruta->tipo_ruta == 'senderismo' ? 'selected' : '' }}>Senderismo</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label for="dificultad" class="label-create">Dificultad</label>
                                <select class="form-select input-create" id="dificultad" name="dificultad" required>
                                    <option value="muy_facil" {{ $ruta->dificultad == 'muy_facil' ? 'selected' : '' }}>Muy Fácil</option>
                                    <option value="facil" {{ $ruta->dificultad == 'facil' ? 'selected' : '' }}>Fácil</option>
                                    <option value="intermedio" {{ $ruta->dificultad == 'intermedio' ? 'selected' : '' }}>Intermedio</option>
                                    <option value="dificil" {{ $ruta->dificultad == 'dificil' ? 'selected' : '' }}>Difícil</option>
                                    <option value="muy_dificil" {{ $ruta->dificultad == 'muy_dificil' ? 'selected' : '' }}>Muy Difícil</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label for="km" class="label-create">Distancia (km)</label>
                                <input type="number" step="0.1" class="form-control input-create" id="km" name="km" value="{{ $ruta->km }}" required>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label for="desnivel" class="label-create">Desnivel (m)</label>
                                <input type="number" class="form-control input-create" id="desnivel" name="desnivel" value="{{ $ruta->desnivel }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="descripcion" class="label-create">Descripción</label>
                            <textarea class="form-control input-create" id="descripcion" name="descripcion" rows="5" required>{{ $ruta->descripcion }}</textarea>
                        </div>

                        <div class="mb-5">
                            <label class="label-create d-block">Imagen Principal</label>
                            @if($ruta->imagen)
                                <img src="{{ asset('storage/' . $ruta->imagen) }}" alt="Imagen actual" style="height: 100px; border-radius: 8px; margin-bottom: 10px;">
                            @endif
                            <input type="file" class="form-control input-create mt-2" id="imagen_principal" name="imagen_principal" accept="image/*">
                            <small class="text-muted">Si no subes ninguna, se mantendrá la imagen actual.</small>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('dashboard') }}" class="btn btn-cancel px-4">Cancelar</a>
                            <button type="submit" class="btn btn-create btn-submit px-5">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection