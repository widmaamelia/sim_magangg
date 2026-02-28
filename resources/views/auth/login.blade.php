<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Login - SIM Magang</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Plus+Jakarta+Sans:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --blue: #2563eb;
      --blue2: #3b82f6;
      --bg: #f0f6ff;
      --text: #1e3a5f;
      --muted: #6b8ab3;
      --white: #ffffff;
    }

    body {
      background: radial-gradient(circle at 25% 30%, #dbeafe 0%, #eff6ff 60%, #f8fafc 100%);
      font-family: 'Plus Jakarta Sans', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .login-card {
      width: 380px;
      background: var(--white);
      border-radius: 20px;
      box-shadow: 0 15px 45px rgba(37,99,235,0.15);
      padding: 42px 36px;
      transition: 0.3s ease;
      position: relative;
    }

    .login-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 18px 55px rgba(37,99,235,0.22);
    }

    .logo {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 26px;
      color: var(--blue);
      text-align: center;
      margin-bottom: 8px;
    }

    .logo span {
      background: linear-gradient(90deg, var(--blue2), var(--blue));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    h4 {
      text-align: center;
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      color: var(--text);
      margin-bottom: 30px;
      font-size: 20px;
    }

    label {
      font-size: 13px;
      font-weight: 600;
      color: var(--text);
    }

    input.form-control {
      border-radius: 10px;
      border: 1.5px solid #cbd5e1;
      background: #f8fbff;
      padding: 11px 13px;
      font-size: 14px;
      transition: 0.2s ease;
    }

    input.form-control:focus {
      border-color: var(--blue);
      box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
      background: #fff;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--blue2), var(--blue));
      border: none;
      border-radius: 12px;
      padding: 12px;
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 15px;
      box-shadow: 0 8px 25px rgba(37,99,235,0.3);
      transition: all 0.2s ease;
      margin-top: 6px;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 35px rgba(37,99,235,0.35);
    }

    .small {
      font-size: 13px;
      color: var(--muted);
      margin-top: 16px;
    }

    .small a {
      color: var(--blue);
      text-decoration: none;
      font-weight: 600;
    }

    .small a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="login-card">
    <div class="logo">SIM <span>Magang</span></div>
    <h4>Masuk Akun Mahasiswa</h4>

    <form action="{{ route('login') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-4">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Masuk Sekarang →</button>
    </form>

    <p class="text-center small">
      Mahasiswa baru? <a href="{{ route('register') }}">Daftar di sini</a>
    </p>
  </div>
</body>
</html>