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
            <!-- Servicios -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Servicios</a>
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="fas fa-dog me-2"></i>Agregar mascota</a></li>
                    <li><a href="{{ route('adoptar') }}"><i class="fas fa-heart me-2"></i>Adoptar</a></li>
                    <li><a href="#"><i class="fas fa-home me-2"></i>Alojamiento</a></li>
                    <li><a href="{{ route('vacunacion') }}"><i class="fas fa-syringe me-2"></i>Vacunación</a></li>
                    <li><a href="#"><i class="fas fa-shower me-2"></i>Baño</a></li>
                    <li><a href="#"><i class="fas fa-cut me-2"></i>Corte de Pelo</a></li>
                    <li><a href="#"><i class="fas fa-paw me-2"></i>Corte de Uñas</a></li>
                    <li><a href="#"><i class="fas fa-folder-open me-2"></i>Historial</a></li>

                    @if(session('perfil') === 'admin')
                    <li><a href="#"><i class="fas fa-plus me-2"></i>Agregar vacuna</a></li>
                    <li><a href="#"><i class="fas fa-user-shield me-2"></i>Agregar admin</a></li>
                    @endif
                </ul>
            </li>

            <!-- Reportes -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Reportes</a>
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="fas fa-exclamation-triangle me-2"></i>Reporte de maltrato</a></li>
                    <li><a href="#"><i class="fas fa-search-location me-2"></i>Reporte de extravío</a></li>

                    @if(session('perfil') === 'admin')
                    <li><a href="#"><i class="fas fa-syringe me-2"></i>Reporte vacuna</a></li>
                    <li><a href="#"><i class="fas fa-heartbeat me-2"></i>Reporte adopción</a></li>
                    @endif
                </ul>
            </li>

            @auth
            @if(session('perfil') === 'admin')
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
        <!-- Servicios -->
        <div class="sidebar-title">Servicios</div>
        <ul class="sidebar-section">
            <li><a href="#"><i class="fas fa-dog me-2"></i>Agregar mascota</a></li>
            <li><a href="{{ route('adoptar') }}"><i class="fas fa-heart me-2"></i>Adoptar</a></li>
            <li><a href="#"><i class="fas fa-home me-2"></i>Alojamiento</a></li>
            <li><a href="{{ route('vacunacion') }}"><i class="fas fa-syringe me-2"></i>Vacunación</a></li>
            <li><a href="#"><i class="fas fa-shower me-2"></i>Baño</a></li>
            <li><a href="#"><i class="fas fa-cut me-2"></i>Corte de Pelo</a></li>
            <li><a href="#"><i class="fas fa-paw me-2"></i>Corte de Uñas</a></li>
            <li><a href="#"><i class="fas fa-folder-open me-2"></i>Historial</a></li>

            @if(session('perfil') === 'admin')
            <li><a href="#"><i class="fas fa-plus me-2"></i>Agregar vacuna</a></li>
            <li><a href="#"><i class="fas fa-user-shield me-2"></i>Agregar admin</a></li>
            @endif
        </ul>

        <!-- Reportes -->
        <div class="sidebar-title">Reportes</div>
        <ul class="sidebar-section">
            <li><a href="#"><i class="fas fa-exclamation-triangle me-2"></i>Reporte de maltrato</a></li>
            <li><a href="#"><i class="fas fa-search-location me-2"></i>Reporte de extravío</a></li>

            @if(session('perfil') === 'admin')
            <li><a href="#"><i class="fas fa-syringe me-2"></i>Reporte vacuna</a></li>
            <li><a href="#"><i class="fas fa-heartbeat me-2"></i>Reporte adopción</a></li>
            @endif
        </ul>

        <!-- Acciones de usuario -->
        @auth
        @if(session('perfil') === 'admin')
        <ul class="sidebar-section">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-tools me-2"></i>Panel Admin</a></li>
        </ul>
        @elseif (session('perfil') === 'cliente')
        <ul class="sidebar-section">
            <li><a href="{{ route('perfil') }}"><i class="fas fa-user me-2"></i>Mi Perfil</a></li>
        </ul>
        @endif
        <ul class="sidebar-section">
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión</button>
                </form>
            </li>
        </ul>
        @else
        <ul class="sidebar-section">
            <li><a href="{{ route('login') }}" class="btn-login"><i class="fas fa-sign-in-alt me-2"></i>Iniciar sesión</a></li>
        </ul>
        @endauth
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('mobileSidebar');
        const toggleButton = document.getElementById('menuToggle');

        // Abre/Cierra el sidebar al hacer clic en el botón hamburguesa
        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        // Cierra sidebar o dropdowns al hacer clic fuera
        document.addEventListener('click', (event) => {
            const target = event.target;

            const clickedInsideSidebar = sidebar.contains(target);
            const clickedMenuToggle = toggleButton.contains(target);
            const clickedDropdownToggle = target.closest('.dropdown-toggle');
            const clickedDropdownMenu = target.closest('.dropdown-menu');

            // Cerrar sidebar si se hace clic fuera
            if (!clickedInsideSidebar && !clickedMenuToggle) {
                sidebar.classList.remove('active');
            }

            // Cerrar menús desplegables si se hace clic fuera
            if (!clickedDropdownToggle && !clickedDropdownMenu) {
                document.querySelectorAll('.dropdown .dropdown-menu').forEach(menu => {
                    menu.style.display = 'none';
                });
            }
        });

        // Mostrar el dropdown al hacer clic
        document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
            toggle.addEventListener('click', (e) => {
                e.preventDefault();
                const menu = toggle.nextElementSibling;

                // Oculta otros dropdowns
                document.querySelectorAll('.dropdown .dropdown-menu').forEach(m => {
                    if (m !== menu) m.style.display = 'none';
                });

                // Alterna el actual
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            });
        });
    });
</script>