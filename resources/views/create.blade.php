<!--

FORMULARIO PARA PUBLICAR UNA NUEVA RUTA

-->

@extends('base') 

@section('contenido')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-create shadow-sm border-0">
                <div class="card-body p-5">
                    <h1 class="titulo-create mb-4">Publicar una nueva Ruta</h1>

                    <form action="/rutas" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label label-create">Nombre de la ruta</label>
                            <input type="text" name="nombre" class="form-control input-create" required>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label label-create">Distancia (en KM)</label>
                                <input type="number" name="km" class="form-control input-create" step="0.01" min="0" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label label-create">Desnivel (en metros)</label>
                                <input type="number" name="desnivel" class="form-control input-create" min="0" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label label-create">Descripción</label>
                            <textarea name="descripcion" rows="5" class="form-control input-create" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label label-create">Lugar de salida</label>
                            <select name="lugar_id" class="form-select input-create" required>
                                <option value="">Selecciona un lugar...</option>
                                @foreach($lugares as $lugar)
                                    <option value="{{ $lugar->id }}">{{ $lugar->lugar }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label label-create">Tipo de ruta</label>
                                <select name="tipo_ruta" class="form-select input-create" required>
                                    <option value="">Selecciona un tipo...</option>
                                    <option value="turismo">Turismo</option>
                                    <option value="senderismo">Senderismo</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label label-create">Dificultad</label>
                                <select name="dificultad" class="form-select input-create" required>
                                    <option value="">Selecciona dificultad...</option>
                                    <option value="muy_facil">Muy fácil</option>
                                    <option value="facil">Fácil</option>
                                    <option value="intermedio">Intermedio</option>
                                    <option value="dificil">Difícil</option>
                                    <option value="muy_dificil">Muy difícil</option>
                                </select>
                            </div>
                        </div>

                        <hr class="divisor-create">

                        <div class="mb-4">
                            <label class="form-label label-create">Imagen Principal (Portada)</label>
                            <input type="file" name="imagen_principal" class="form-control input-create" accept="image/*">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-create btn-submit">Guardar Ruta</button>
                            <a href="{{ route('rutas.index') }}" class="btn btn-create btn-cancel">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection