@extends('base')

@section('contenido')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
            <div class="card card-create shadow-sm border-0">
                <div class="card-body p-5">
                    <h1 class="titulo-create mb-4">Iniciar Sesión</h1>

                    @if (session('status'))
                        <div class="alert alert-success mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label label-create">Email</label>
                            <input id="email" class="form-control input-create" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label label-create">Contraseña</label>
                            <input id="password" class="form-control input-create" type="password" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 form-check">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label for="remember_me" class="form-check-label text-muted small">Recuérdame</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            @if (Route::has('password.request'))
                                <a class="auth-link text-decoration-none small fw-bold" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif

                            <button type="submit" class="btn btn-create btn-submit">
                                Iniciar Sesión
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
