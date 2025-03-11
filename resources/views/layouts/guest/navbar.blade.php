<nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="/#hero" class="active">Home</a></li>
        <li><a href="/#about">About</a></li>
        <li><a href="/#stats">Stats</a></li>
        <li><a href="/#gallery">Gallery</a></li>
        {{-- <li><a href="/#team">Team</a></li> --}}
        <li><a href="/#contact">Contact</a></li>
        @if (Route::has('login'))
            @auth
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
            @endauth
        @endif
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>
