@include('header')
    <h1>Publicar una nueva Ruta</h1>

    <form action="/rutas" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Nombre de la ruta:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Distancia (en KM):</label><br>
        <input type="number" name="km" step="0.01" min="0" required><br><br>

        <label>Descripción:</label><br>
        <textarea name="descripcion" rows="4" required></textarea><br><br>

        <label>Tipos de Ruta:</label><br>
        <select name="tipos[]" multiple required>
            @foreach($tipos as $tipo)
                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
            @endforeach
        </select>
        <small>Manten presionado Ctrl (o Cmd en Mac) para seleccionar varios.</small><br><br>

        <hr>

        <label>Imagen Principal (Portada):</label><br>
        <input type="file" name="imagen_principal" accept="image/*"><br><br>

        <label>Galería de Imágenes Adicionales:</label><br>
        <input type="file" name="galeria[]" multiple accept="image/*"><br><br>

        <button type="submit">Guardar Ruta</button>
    </form>
@include('footer')