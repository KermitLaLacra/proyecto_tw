@extends('base')

@section('contenido')
<div class="contact-page container mt-5">
    <style>
        .formulario-contacto .form-floating {
            position: relative;
        }

        .formulario-contacto > div > label {
            position: absolute;
            top: 1rem;
            left: 0.75rem;
            z-index: 2;
            height: 1.5em;
            padding: 0 0.25rem;
            margin-bottom: 0;
            font-size: 1rem;
            color: #6c757d;
            pointer-events: none;
            cursor: text;
            border: 1px solid transparent;
            transform-origin: 0 0;
            transition: opacity 0.1s ease-in-out, transform 0.1s ease-in-out;
        }

        .formulario-contacto .form-control {
            padding: 1.25rem 0.75rem 0.5rem 0.75rem;
            border: 1px solid #ced4da;
            color: #212529;
        }

        .formulario-contacto .form-control:focus,
        .formulario-contacto .form-control:not(:placeholder-shown) {
            color: #212529;
            border-color: #495057;
        }

        .formulario-contacto .form-control:focus + label,
        .formulario-contacto .form-control:not(:placeholder-shown) + label {
            opacity: 0.65;
            transform: scale(0.85) translateY(-0.5rem) translateX(-0.15rem);
        }

        .btn-enviar {
            padding: 0.5rem 1rem;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <h1 class="contact-titulo">Contacta con nosotros</h1>
            <p class="contact-subtitulo">¿Tienes alguna duda sobre nuestras rutas? Escríbenos.</p>

            <!-- Formulario con etiquetas flotantes y envío al controlador -->
            <form action="{{ route('contacto.enviar') }}" method="POST" class="formulario-contacto">
                @csrf

                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="form-floating mb-3">
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder=" " required>
                    <label for="nombre">Tu nombre completo</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" id="email" name="email" class="form-control" placeholder=" " required>
                    <label for="email">Tu correo electrónico</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea id="mensaje" name="mensaje" class="form-control" placeholder=" " style="height: 150px;" required></textarea>
                    <label for="mensaje">¿En qué podemos ayudarte?</label>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn-enviar btn btn-primary">Enviar Mensaje</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection