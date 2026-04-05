<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Nature Clean</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f4f1ee; 
            display: flex; 
            align-items: center; 
            height: 100vh;
        }
        .card-login {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .login-header {
            background-color: #6F4E37;
            color: white;
            padding: 30px;
            text-align: center;
        }
        .btn-brown {
            background-color: #6F4E37;
            color: white;
            border-radius: 10px;
            padding: 12px;
            border: none;
        }
        .btn-brown:hover {
            background-color: #533a29;
            color: white;
        }
        .form-control:focus {
            border-color: #6F4E37;
            box-shadow: 0 0 0 0.25rem rgba(111, 78, 55, 0.25);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card card-login">
                <div class="login-header">
                    <h4 class="fw-bold m-0">NATURE CLEAN</h4>
                    <small>
                        {{ request()->query('role') == 'owner' ? 'Owner Authentication' : 'Admin Authentication' }}
                    </small>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger small">{{ $errors->first() }}</div>
                    @endif

                    <form action="{{ route('login') }}" method="POST" autocomplete="off">
                        @csrf
                        
                        <input type="text" name="prevent_autofill" style="display:none" />
                        <input type="password" name="password_fake" style="display:none" />

                        <input type="hidden" name="role" value="{{ request()->query('role', 'admin') }}">

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" 
                                   placeholder="{{ request()->query('role') == 'owner' ? 'owner@gmail.com' : 'admin@gmail.com' }}" 
                                   required autofocus autocomplete="off">
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" 
                                   placeholder="********" required autocomplete="new-password">
                        </div>
                        <button type="submit" class="btn btn-brown w-100 fw-bold">MASUK SEKARANG</button>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('reservasi.index') }}" class="text-muted small text-decoration-none">← Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>