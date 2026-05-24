@extends('base')

@section('contenido')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
            <div class="card card-create shadow-sm border-0">
                <div class="card-body p-5">
                    <h1 class="titulo-create mb-4">Recuperar Contraseña</h1>

                    <div class="mb-4 text-muted small" style="line-height: 1.6;">
                        ¿Olvidaste tu contraseña? No hay problema. Indícanos tu dirección de correo electrónico y te enviaremos un enlace para que puedas elegir una nueva.
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success mb-4 small">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label label-create">Email</label>
                            <input id="email" class="form-control input-create" type="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-create btn-submit">
                                Enviar Enlace
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection