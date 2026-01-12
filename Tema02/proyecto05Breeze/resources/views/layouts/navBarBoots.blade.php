<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li>
                    <a class="nav-link active" aria-current="page" href="{{ url('/home') }}">
                            Home
                        </a>
                </li>

                    @auth

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{Auth::user()->name}}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Pedidos</a></li>
                                <li class="dropdown-item">
                                    <form method="POST" action="{{ route('logout') }}" class="inline">
                                        @csrf
                                        <button>
                                            Logout
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </li>

                    @endauth

                    @guest
                        <a href="{{ route('login') }}">
                                Login
                            </a>
                        <a href="{{ route('register') }}">
                                    ¡Regístrate!
                                </a>
                    @endguest


                </ul>
        </div>
    </div>
</nav>
