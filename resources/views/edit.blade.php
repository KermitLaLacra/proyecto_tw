@include('header')
    <input type="text" name="nombre" value="{{ $ruta->nombre }}">

    <select name="lugar_id">
        @foreach($lugares as $lugar)
            <option value="{{ $lugar->id }}" @selected($ruta->lugar_id == $lugar->id)>
                {{ $lugar->lugar }}
            </option>
        @endforeach
    </select>

    @foreach
        <input type="checkbox" name="tipos[]" value="{{ $tipo->id }}" @checked($ruta->tipos->constains($tipo->id))>
        {{ $tipo->nombre }}
    @endforeach
@include('footer')