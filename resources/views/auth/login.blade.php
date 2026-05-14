<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hotel UKK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #2c3e50; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { background: #fff; border-radius: 16px; padding: 40px; width: 100%; max-width: 420px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        .login-card .brand { text-align: center; margin-bottom: 30px; }
        .login-card .brand i { font-size: 3rem; color: #2c3e50; }
        .login-card .brand h4 { margin-top: 10px; font-weight: 700; color: #2c3e50; }
        .btn-login { background: #2c3e50; color: #fff; width: 100%; padding: 12px; font-weight: 600; border-radius: 8px; }
        .btn-login:hover { background: #34495e; color: #fff; }
    </style>
</head>
<body>
<div class="login-card">
    <div class="brand">
        <i class="bi bi-building"></i>
        <h4>Hotel UKK</h4>
        <p class="text-muted mb-0">Sistem Manajemen Hotel</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ url('/login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="admin@hotel.com" required autofocus>
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
        </div>
        <button type="submit" class="btn btn-login"><i class="bi bi-box-arrow-in-right"></i> Masuk</button>
    </form>

    <div class="text-center mt-4 text-muted" style="font-size:0.8rem">
        <strong>Admin:</strong> admin@hotel.com / password<br>
        <strong>Resepsionis:</strong> resepsionis@hotel.com / password
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
