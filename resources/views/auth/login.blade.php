<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Nature Clean</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root { 
            --primary: #5D4037; 
            --accent: #8D6E63;
            --bg-body: #F5EBE0; 
            --text-main: #3E2723;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: linear-gradient(135deg, #F5EBE0 0%, #E3D5CA 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-main);
            overflow: hidden;
        }

        /* Dekorasi Lingkaran Background */
        .bg-circle {
            position: absolute;
            z-index: -1;
            border-radius: 50%;
            background: var(--primary);
            opacity: 0.05;
        }

        .card-login {
            border: none;
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 50px rgba(93, 64, 55, 0.15);
            width: 100%;
            max-width: 400px;
            overflow: hidden;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-header {
            background: var(--primary);
            padding: 40px 30px;
            text-align: center;
            color: white;
            position: relative;
        }

        .login-header i {
            font-size: 2.5rem;
            margin-bottom: 15px;
            display: block;
            color: #E3D5CA;
        }

        .login-header h4 {
            font-weight: 800;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .login-header span {
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.8;
        }

        .form-label {
            font-weight: 800;
            font-size: 0.8rem;
            color: var(--primary);
            margin-left: 5px;
        }

        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #eee;
            border-right: none;
            border-radius: 15px 0 0 15px;
            color: var(--accent);
        }

        .form-control {
            border: 2px solid #eee;
            border-left: none;
            border-radius: 0 15px 15px 0;
            padding: 12px;
            font-weight: 700;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #eee;
            box-shadow: none;
            background: #fff;
        }

        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            border-color: var(--accent);
        }

        .btn-login {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 15px;
            padding: 14px;
            font-weight: 800;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s;
            letter-spacing: 1px;
        }

        .btn-login:hover {
            background: var(--text-main);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(93, 64, 55, 0.2);
            color: white;
        }

        .back-link {
            text-align: center;
            margin-top: 25px;
        }

        .back-link a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 800;
            font-size: 0.85rem;
            transition: 0.3s;
        }

        .back-link a:hover {
            color: var(--primary);
        }

        .alert-custom {
            border-radius: 15px;
            font-weight: 700;
            font-size: 0.8rem;
            border: none;
            background: #fee2e2;
            color: #b91c1c;
        }
    </style>
</head>
<body>

<div class="bg-circle" style="width: 400px; height: 400px; top: -100px; left: -100px;"></div>
<div class="bg-circle" style="width: 300px; height: 300px; bottom: -50px; right: -50px;"></div>

<div class="container d-flex justify-content-center">
    <div class="card card-login">
        <div class="login-header">
            <i class="fas fa-leaf"></i>
            <h4>NATURE CLEAN</h4>
            <span>
                {{ request()->query('role') == 'owner' ? 'Owner Portal' : 'Admin Portal' }}
            </span>
        </div>
        
        <div class="card-body p-4 pt-5">
            @if($errors->any())
                <div class="alert alert-custom p-3 mb-4 shadow-sm">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="role" value="{{ request()->query('role', 'admin') }}">

                <div class="mb-3">
                    <label class="form-label">EMAIL ADDRESS</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" 
                               placeholder="nama@email.com" 
                               required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">PASSWORD</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" 
                               placeholder="********" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-login">
                    MASUK SEKARANG <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </form>

            <div class="back-link">
                <a href="{{ route('reservasi.index') }}">
                    <i class="fas fa-long-arrow-alt-left me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>