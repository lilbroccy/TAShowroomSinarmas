<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('user/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/auth.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="auth-container">
            <img src="{{ asset('user/img/logo-doang.jpg') }}" alt="Logo" class="logo">
            <h2 class="text-center">Login</h2>
            <form method="POST" action="{{ route('loginUser') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form></br>
            <p class="text-center">Belum punya akun? <a href="{{ route('showRegisterForm') }}">Registrasi</a></p>
        </div>
    </div>
</body>
</html>
