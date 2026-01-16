<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Monitoring PA</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/bootstrap.css') }}">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .login-title {
            text-align: center;
            color: #333;
            margin-bottom: 10px;
        }
        .login-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .text-center a {
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1 class="login-title">Sistem Monitoring PA</h1>
        <p class="login-subtitle">Project Akhir Monitoring Progress</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
                @error('email')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" placeholder="Password" required autocomplete="current-password">
                @error('password')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Keep me logged in
                </label>
            </div>

            <button type="submit" class="btn btn-primary">Log in</button>
        </form>

        <div class="text-center mt-3">
            <p>Don't have an account? <a href="{{ route('register') }}">Sign up</a>.</p>
            @if (Route::has('password.request'))
                <p><a href="{{ route('password.request') }}">Forgot password?</a></p>
            @endif
        </div>
    </div>
</body>

</html>
