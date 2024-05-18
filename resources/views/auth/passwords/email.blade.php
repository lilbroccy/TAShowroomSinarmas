<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="{{ asset('user/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/auth.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="auth-container">
            <img src="{{ asset('user/img/logo-doang.jpg') }}" alt="Logo" class="logo">
            <h2 class="text-center">Reset Password</h2>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required autofocus>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
            </form>
        </div>
    </div>
</body>
</html>
