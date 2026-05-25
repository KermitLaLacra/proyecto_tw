<section class="card-profile">
    <header>
        <h2 class="titulo-profile">Información del Perfil</h2>
        <p class="texto-profile">Actualiza los datos básicos de tu cuenta y tu dirección de correo electrónico.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="label-profile">Nombre completo</label>
            <input id="name" name="name" type="text" class="input-profile @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="label-profile">Correo Electrónico</label>
            <input id="email" name="email" type="email" class="input-profile @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-warning small fw-medium">
                    Tu dirección de correo no está verificada.
                    <button form="send-verification" class="btn btn-link p-0 text-decoration-underline align-baseline small text-secondary">
                        Haz clic aquí para reenviar el email de verificación.
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <div class="mt-2 text-success fw-bold small">
                            Se ha enviado un nuevo enlace de verificación a tu correo.
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-create btn-submit">Guardar Cambios</button>

            @if (session('status') === 'profile-updated')
                <span class="text-success small fw-semibold">✓ Guardado correctamente</span>
            @endif
        </div>
    </form>
</section>