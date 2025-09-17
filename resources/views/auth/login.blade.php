<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>POS APP | Login</title>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Bootstrap & AdminLTE -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-box {
      width: 400px;
    }
    .card {
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        animation: fadeIn 0.8s ease-in-out;
        background: rgba(255, 255, 255, 0.2); /* transparan putih */
        backdrop-filter: blur(10px); /* efek kaca buram */
        -webkit-backdrop-filter: blur(10px);
  }

    .login-logo a {
      font-weight: 700;
      font-size: 28px;
      color: #007bff;
    }
    .form-control {
      border-radius: 12px;
    }
    .btn-primary {
      border-radius: 12px;
      font-weight: 600;
      background: linear-gradient(135deg, #4facfe, #00f2fe);
      border: none;
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 242, 254, 0.4);
    }
    .alert {
      border-radius: 12px;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .login-box {
      width: 400px;
      max-width: 90%; /* biar fleksibel di layar kecil */
      }

    @media (max-width: 576px) {
    .login-box {
        width: 100%;
        margin: 0 15px; /* kasih jarak biar tidak nempel tepi */
    }
      .login-logo a {
        font-size: 22px;
      }
    }

  </style>
</head>
<body>
<div class="login-box">
  <div class="card">
    <div class="card-body login-card-body">
      <div class="login-logo mb-3 text-center">
        <a href="#"><b>POS</b> APP</a>
        <p class="text-muted" style="font-size:14px;">Sign in to continue</p>
      </div>

      @if ($errors->any())
          <div class="alert alert-danger">
              <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text"><i class="fas fa-envelope"></i></div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text"><i class="fas fa-lock"></i></div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
      </form>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('adminlte') }}/dist/js/adminlte.min.js"></script>
</body>
</html>
