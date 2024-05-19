<nav class="navbar">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <a class="navbar-brand">
            {{ $title }}
        </a>
        <div class="dropdown">
            <button class="dropdown-toogler" type="button" data-bs-toggle="dropdown" data-bs-target="#dropdown-menu"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span>{{ Auth::user()->name }}</span>
            </button>
            <ul class="dropdown-menu">
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
