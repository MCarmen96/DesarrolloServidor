<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="{{ url('/') }}" class="d-inline-flex link-body-emphasis text-decoration-none">
                <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="{{ url('/') }}" class="nav-link px-2 link-secondary">Home</a></li>
            <li><a href="#" class="nav-link px-2">Features</a></li>
            <li><a href="#" class="nav-link px-2">Pricing</a></li>
            <li><a href="#" class="nav-link px-2">FAQs</a></li>
            <li><a href="#" class="nav-link px-2">About</a></li>
        </ul>

        <div class="col-md-3 text-end">
            @if (Route::has('login'))
                @auth
                    {{-- Si el usuario está logueado, lo mandamos al Dashboard --}}
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary">Dashboard</a>

                    {{-- Botón de Logout (Opcional pero recomendado) --}}
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger ms-2">Log out</button>
                    </form>
                @else
                    {{-- Si no está logueado, botones de Login y Registro --}}
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">Sign-up</a>
                    @endif
                @endauth
            @endif
        </div>
    </header>
</div>
