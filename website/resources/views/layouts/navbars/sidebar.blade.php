<div class="sidebar">
    <div class="sidebar-header">
        <a href="" class="logo">
            <img src="{{ asset('img/jubelo.png') }}" class="img-fluid sidebar-jubelo-img" alt="plastic">
        </a>
    </div>
    <ul class="sidebar-menu">
        <li><a class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li><a class="{{ request()->routeIs('') ? 'active' : '' }}" href="">Today Schedule</a></li>
        <li><a class="{{ request()->routeIs('') ? 'active' : '' }}" href="">History</a></li>
        <li><a class="{{ request()->routeIs('driver.index') ? 'active' : '' }}" href="{{ route('driver.index') }}">Manage Drivers</a></li>
    </ul>
    <footer class="footer-sidebar">
        <div class="container-fluid">
            <p>Jubelo Operational Management</p>
            <div class="copyright">
                &copy; {{ now()->year }} {{ __('made with') }} <i class="tim-icons icon-heart-2"></i> {{ __('by') }}
                <a>{{ __('KoTA 104') }}</a>
            </div>
        </div>
    </footer>
</div>
