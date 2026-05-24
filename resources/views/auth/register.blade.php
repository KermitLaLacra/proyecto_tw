@extends('base')

@section('contenido')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card card-create shadow-sm border-0">
                <div class="card-body p-5">
                    <h1 class="titulo-create mb-4">Registro</h1>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label label-create">Nombre</label>
                            <input id="name" class="form-control input-create" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label label-create">Email</label>
                            <input id="email" class="form-control input-create" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="password" class="form-label label-create">Contraseña</label>
                                <input id="password" class="form-control input-create" type="password" name="password" required autocomplete="new-password">
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label label-create">Confirmar Contraseña</label>
                                <input id="password_confirmation" class="form-control input-create" type="password" name="password_confirmation" required autocomplete="new-password">
                                @error('password_confirmation')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
                            <a class="auth-link text-decoration-none small fw-bold" href="{{ route('login') }}">
                                ¿Ya estás registrado?
                            </a>

                            <button type="submit" class="btn btn-create btn-submit">
                                Registrarse
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection