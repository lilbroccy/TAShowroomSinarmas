<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
            <h2>Login</h2>
            <form method="POST" action="{{ route('loginUser') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required autofocus>
                    
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
            <p>Belum punya akun? <a href="#">Registrasi</a></p>
        </div>
    </div>
</body>
</html>
