<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-logo">
            <img class="logo-img" src="{{ Vite::asset('resources/images/Logo.png') }}" alt="Logo">
        </div>

        <div class="navbar-content">
            <a href="{{ route('home') }}" class="logo-text">Patitas felices</a>

            <ul class="navbar-links">
                <li><a href="{{ route('adoptar') }}">Adoptar</a></li>
                <li><a href="{{ route('vacunacion') }}">Vacunación</a></li>
                <li><a href="{{ route('contacto') }}">Contacto</a></li>

                @auth
                @if (auth()->user()->role === 'admin')
                <li><a href="{{ route('admin.dashboard') }}">Panel Admin</a></li>
                @elseif (auth()->user()->role === 'cliente')
                <li><a href="{{ route('perfil') }}">Mi Perfil</a></li>
                @endif

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-logout">Cerrar sesión</button>
                    </form>
                </li>
                @else
                <li><a href="{{ route('login') }}" class="btn-login">Iniciar sesión</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>