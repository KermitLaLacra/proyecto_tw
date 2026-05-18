<!--

VISTA PARA EDITAR UNA RUTA, SE MUESTRA UN FORMULARIO CON LOS DATOS DE LA RUTA SELECCIONADA

-->

@include('header')
    <input type="text" name="nombre" value="{{ $ruta->nombre }}">

    <select name="lugar_id">
        @foreach($lugares as $lugar)
            <option value="{{ $lugar->id }}" @selected($ruta->lugar_id == $lugar->id)>
                {{ $lugar->lugar }}
            </option>
        @endforeach
    </select>

    @foreach($tipos as $tipo)
        <input type="checkbox" name="tipos[]" value="{{ $tipo->id }}" @checked($ruta->tipos->contains($tipo->id))>
        {{ $tipo->nombre }}
    @endforeach
@include('footer')