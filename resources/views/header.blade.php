<header>
    <nav class="navbar navbar-expand-lg custom-bg-green py-3">
        <div class="container-fluid px-4">
            
            <a class="navbar-brand text-white fw-bold fs-3" href="/">Ruta del Alioli</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuPrincipal">
                
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-text-white" href="/rutas">Listado de Rutas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-text-white" href="{{ auth()->check() ? '/rutas/create' : '/login' }}">
                            Compartir Ruta
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link nav-text-yellow fw-bold" href="/dashboard">Mi Perfil</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link nav-text-yellow fw-bold" href="/login">Iniciar Sesión</a>
                        </li>
                    @endauth
                </ul>
            </div>

        </div>
    </nav>
</header>