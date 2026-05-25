<section class="card-profile">
    <header>
        <h2 class="titulo-profile">Actualizar Contraseña</h2>
        <p class="texto-profile">Asegúrate de utilizar una contraseña larga y compleja para mantener tu cuenta completamente protegida.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="label-profile">Contraseña Actual</label>
            <input id="update_password_current_password" name="current_password" type="password" class="input-profile @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="label-profile">Nueva Contraseña</label>
            <input id="update_password_password" name="password" type="password" class="input-profile @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="label-profile">Confirmar Nueva Contraseña</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="input-profile @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-create btn-submit">Actualizar Clave</button>

            @if (session('status') === 'password-updated')
                <span class="text-success small fw-semibold">✓ Contraseña cambiada</span>
            @endif
        </div>
    </form>
</section>