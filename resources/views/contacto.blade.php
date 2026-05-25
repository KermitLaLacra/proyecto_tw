@extends('base')

@section('contenido')
<div class="contact-page container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <h1 class="contact-titulo">Contacta con nosotros</h1>
            <p class="contact-subtitulo">¿Tienes alguna duda sobre nuestras rutas? Escríbenos.</p>

            <!-- Asumiendo que tienes un ContactoController@enviar -->
            <form action="/contacto/enviar" method="POST" class="formulario-contacto">
                @csrf

                <div class="grupo-input">
                    <label for="nombre">Tu nombre completo</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>

                <div class="grupo-input">
                    <label for="email">Tu correo electrónico</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="grupo-input">
                    <label for="mensaje">¿En qué podemos ayudarte?</label>
                    <textarea id="mensaje" name="mensaje" rows="6" required></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn-enviar">Enviar Mensaje</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection