<nav class="navbar">
    <div class="navbar-container">
        <!-- Lado izquierdo: Logo + Marca -->
        <div class="navbar-left d-flex align-items-center">
            <div class="navbar-logo">
                <img class="logo-img" src="{{ Vite::asset('resources/images/Logo.png') }}" alt="Logo">
            </div>
            <a href="{{ route('home') }}" class="logo-text">Patitas felices</a>
        </div>

        <!-- Botón hamburguesa solo visible en móvil -->
        <button class="menu-toggle d-md-none" id="menuToggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Lado derecho: enlaces de navegación -->
        <ul class="navbar-links d-none d-md-flex">
            <!-- Menú desplegable: Servicios -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Servicios</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Agregar mascota</a></li>
                    <li><a href="{{ route('adoptar') }}">Adoptar</a></li>
                    <li><a href="#">Alojamiento</a></li>
                    <li><a href="{{ route('vacunacion') }}">Vacunación</a></li>
                    <li><a href="#">Baño</a></li>
                    <li><a href="#">Corte de Pelo</a></li>
                    <li><a href="#">Corte de Uñas</a></li>
                    <li><a href="#">Historial</a></li>

                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <li><a href="#">Agregar vacuna</a></li>
                    <li><a href="#">Agregar admin</a></li>
                    @endif
                </ul>
            </li>

            <!-- Menú desplegable: Reportes -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Reportes</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Reporte de maltrato</a></li>
                    <li><a href="#">Reporte de extravío</a></li>

                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <li><a href="#">Reporte vacuna</a></li>
                    <li><a href="#">Reporte adopción</a></li>
                    @endif
                </ul>
            </li>

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

    <!-- Sidebar móvil -->
    <div class="mobile-sidebar d-md-none" id="mobileSidebar">
        <ul class="navbar-links d-none d-md-flex">
            <!-- Menú desplegable: Servicios -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Servicios</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Agregar mascota</a></li>
                    <li><a href="{{ route('adoptar') }}">Adoptar</a></li>
                    <li><a href="#">Alojamiento</a></li>
                    <li><a href="{{ route('vacunacion') }}">Vacunación</a></li>
                    <li><a href="#">Baño</a></li>
                    <li><a href="#">Corte de Pelo</a></li>
                    <li><a href="#">Corte de Uñas</a></li>
                    <li><a href="#">Historial</a></li>

                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <li><a href="#">Agregar vacuna</a></li>
                    <li><a href="#">Agregar admin</a></li>
                    @endif
                </ul>
            </li>

            <!-- Menú desplegable: Reportes -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Reportes</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Reporte de maltrato</a></li>
                    <li><a href="#">Reporte de extravío</a></li>

                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <li><a href="#">Reporte vacuna</a></li>
                    <li><a href="#">Reporte adopción</a></li>
                    @endif
                </ul>
            </li>


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
</nav>