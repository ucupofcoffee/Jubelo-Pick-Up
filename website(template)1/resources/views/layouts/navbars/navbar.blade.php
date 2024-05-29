@auth()
    @include('layouts.navbars.navs.auth', ['title' => $title])
@endauth
    
@guest()
    @include('layouts.navbars.navs.guest')
@endguest