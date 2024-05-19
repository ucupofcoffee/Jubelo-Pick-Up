<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Load Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles untuk halaman registrasi */
        body {
            background-color: #f4f4f4;
        }

        .register-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            margin-top: 100px;
        }

        .register-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 20px;
        }

        .btn-register {
            border-radius: 20px;
            background-color: #343a40;
            border-color: #343a40;
        }

        .btn-register:hover {
            background-color: #232527;
            border-color: #232527;
        }

        .login-link {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <h2>Register</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf <!-- Laravel CSRF protection -->
                <div class="form-group">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Name" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn text-white btn-block btn-register">Register</button>
            </form>
            <div class="login-link">
                <span>Already have an account? </span>
                <a href="{{ route('login') }}">Login</a>
            </div>
        </div>
    </div>
    

    <!-- Load Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
