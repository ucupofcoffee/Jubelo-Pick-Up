@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-8 p-0 with-margin" style="background-color: #0A0082;">
        <div class="login-container">
            <img src="{{ asset('img/jubelo.png') }}" class="img-fluid jubelo-img" alt="plastic">
            <h1>Sign in</h1>
            <p>Welcome Juberiors! Sign in and start monitoring the driver</p>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                    @error('email')
                        <div class="invalid-feedback error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                    @error('password')
                        <div class="invalid-feedback error-message">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-login">Login</button>
            </form>
            <footer class="footer-login">
                <div class="container-fluid">
                    <p>Jubelo Operational Management</p>
                    <div class="copyright">
                        &copy; {{ now()->year }} {{ __('made with') }} <i class="tim-icons icon-heart-2"></i> {{ __('by') }}
                        <a>{{ __('KoTA 104') }}</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <div class="col-4 p-0 with-margin">
        <img src="{{ asset('img/plastic.png') }}" class="img-fluid plastic-img" alt="plastic">
    </div>
</div>
@endsection
