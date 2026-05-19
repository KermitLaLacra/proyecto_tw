<!--

FORMULARIO PARA PUBLICAR UNA NUEVA RUTA

-->

@include('header')

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h1 class="card-title mb-4">Publicar una nueva Ruta</h1>

                    <form action="/rutas" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nombre de la ruta</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Distancia (en KM)</label>
                            <input type="number" name="km" class="form-control" step="0.01" min="0" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" rows="4" class="form-control" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Lugar de salida</label>
                            <select name="lugar_id" class="form-select" required>
                                @foreach($lugares as $lugar)
                                    <option value="{{ $lugar->id }}">{{ $lugar->lugar }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tipo de ruta</label>
                                <select name="tipo_ruta" class="form-select" required>
                                    <option value="turismo">Turismo</option>
                                    <option value="senderismo">Senderismo</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Dificultad</label>
                                <select name="dificultad" class="form-select" required>
                                    <option value="muy_facil">Muy fácil</option>
                                    <option value="facil">Fácil</option>
                                    <option value="intermedio">Intermedio</option>
                                    <option value="dificil">Difícil</option>
                                    <option value="muy_dificil">Muy difícil</option>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <div class="mb-4">
                            <label class="form-label">Imagen Principal (Portada)</label>
                            <input type="file" name="imagen_principal" class="form-control" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-success">Guardar Ruta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@include('footer')