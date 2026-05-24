@extends('base')

@section('contenido')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card card-create shadow-sm border-0">
                <div class="card-body p-5">
                    <h1 class="titulo-create mb-4">Verificar Email</h1>

                    <div class="mb-4 text-muted small" style="line-height: 1.6;">
                        ¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que te acabamos de enviar? Si no recibiste el correo, con gusto te enviaremos otro.
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success mb-4 small">
                            Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-create btn-submit">
                                Reenviar Email
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link auth-link text-decoration-none small p-0 m-0 align-baseline fw-bold">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection