@extends('base')

@section('contenido')
<div class="container">
    <h1 class="titulo-create mb-4">Ajustes de mi Cuenta</h1>

    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">
            
            @include('profile.partials.update-profile-information-form')

            @include('profile.partials.update-password-form')

            @include('profile.partials.delete-user-form')

            <div class="d-grid mt-2 mb-5">
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary w-100 py-3 fw-bold" style="border-radius: 8px; border-width: 2px;">
                        Cerrar Sesión
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection