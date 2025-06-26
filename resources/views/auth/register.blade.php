<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
        }

        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .register-body {
            padding: 2rem;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
        }

        .alert {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="register-card">
                        <div class="register-header">
                            <i class="fas fa-user-plus fa-3x mb-3"></i>
                            <h3 class="mb-0">Buat Akun Baru</h3>
                            <p class="opacity-75">Lengkapi formulir di bawah untuk mendaftar</p>
                        </div>
                        <div class="register-body">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label"><i class="fas fa-user me-1"></i>Nama</label>
                                    <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label"><i class="fas fa-envelope me-1"></i>Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label"><i class="fas fa-lock me-1"></i>Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label"><i class="fas fa-lock me-1"></i>Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-register">
                                        <i class="fas fa-user-plus me-2"></i>Daftar
                                    </button>
                                </div>
                            </form>

                            <div class="text-center mt-3">
                                <small class="text-muted">Sudah punya akun?
                                    <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Masuk sekarang</a>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
