@extends('base')

@section('contenido')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
            <div class="card card-create shadow-sm border-0">
                <div class="card-body p-5">
                    <h1 class="titulo-create mb-4">Nueva Contraseña</h1>

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="mb-4">
                            <label for="email" class="form-label label-create">Email</label>
                            <input id="email" class="form-control input-create" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label label-create">Nueva Contraseña</label>
                            <input id="password" class="form-control input-create" type="password" name="password" required autocomplete="new-password">
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label label-create">Confirmar Contraseña</label>
                            <input id="password_confirmation" class="form-control input-create" type="password" name="password_confirmation" required autocomplete="new-password">
                            @error('password_confirmation')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-create btn-submit">
                                Restablecer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection