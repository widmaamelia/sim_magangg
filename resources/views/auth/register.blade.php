<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Register Mahasiswa - SIM Magang</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Plus+Jakarta+Sans:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --blue: #2563eb;
      --blue2: #3b82f6;
      --text: #1e3a5f;
      --muted: #6b8ab3;
    }

    body {
      background: radial-gradient(circle at 25% 30%, #dbeafe 0%, #eff6ff 60%, #f8fafc 100%);
      font-family: 'Plus Jakarta Sans', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .register-card {
      width: 440px;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 15px 45px rgba(37,99,235,0.15);
      padding: 34px 32px;
      transition: 0.3s ease;
    }

    .register-card:hover {
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
      margin-bottom: 26px;
      font-size: 20px;
    }

    label {
      font-size: 13px;
      font-weight: 600;
      color: var(--text);
    }

    .form-control,
    .form-select {
      border-radius: 10px;
      border: 1.5px solid #cbd5e1;
      background: #f8fbff;
      padding: 10px 12px;
      font-size: 14px;
      transition: 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: var(--blue);
      box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
      background: #fff;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--blue2), var(--blue));
      border: none;
      border-radius: 12px;
      padding: 11px;
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 15px;
      box-shadow: 0 8px 25px rgba(37,99,235,0.3);
      transition: all 0.2s ease;
      margin-top: 8px;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 35px rgba(37,99,235,0.35);
    }

    .small {
      text-align: center;
      font-size: 13px;
      color: var(--muted);
      margin-top: 20px;
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
  <div class="register-card">
    <div class="logo">SIM <span>Magang</span></div>
    <h4>Daftar Akun Mahasiswa</h4>

    <form action="{{ route('register') }}" method="POST">
      @csrf
      <div class="mb-2">
        <label>Nama Lengkap</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
      </div>

      <div class="mb-2">
        <label>NIM</label>
        <input type="text" name="identity_number" class="form-control" value="{{ old('identity_number') }}" required>
      </div>

      <div class="mb-2">
        <label>Kelas</label>
        <select name="kelas" class="form-select" required>
          <option value="" disabled selected>-- Pilih Kelas --</option>
          <option value="MI3A">Manajemen Informatika 3A</option>
          <option value="MI3B">Manajemen Informatika 3B</option>
          <option value="MI3C">Manajemen Informatika 3C</option>
        </select>
      </div>

      <div class="mb-2">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
      </div>

      <div class="mb-2">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Daftar Sekarang →</button>
    </form>

    <p class="small">
      Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
    </p>
  </div>
</body>
</html>