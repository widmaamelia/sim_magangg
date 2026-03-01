<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SIM Magang - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #1E3A8A;
            --primary-hover: #1D4ED8;
            --primary-light: #DBEAFE;
            --bg-body: #F8FAFC;
            --sidebar-width: 250px;
            --text-main: #0F172A;
            --text-muted: #64748B;
            --border: #E2E8F0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            margin: 0;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: #ffffff;
            position: fixed;
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 20px;
            font-weight: 700;
            font-size: 1.2rem;
            border-bottom: 1px solid var(--border);
            color: var(--primary);
        }

        .nav-container {
            padding: 15px;
            flex-grow: 1;
            overflow-y: auto;
        }

        .section-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            margin: 20px 0 8px 10px;
            text-transform: uppercase;
        }

        .nav-link {
            color: var(--text-muted);
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            transition: 0.2s ease;
        }

        .nav-link:hover {
            background: var(--primary-light);
            color: var(--primary);
        }

        .nav-link.active {
            background: var(--primary);
            color: white !important;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px;
        }

        /* ===== TOP NAV ===== */
        .top-nav {
            background: #ffffff;
            padding: 15px 20px;
            border: 1px solid var(--border);
            border-radius: 10px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .avatar-box {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .user-profile-btn {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* ===== LOGOUT ===== */
        .btn-logout {
            background: #DC2626;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 6px;
            width: 100%;
            font-size: 0.9rem;
            margin-top: auto;
            margin-bottom: 20px;
            transition: 0.2s;
        }

        .btn-logout:hover {
            background: #B91C1C;
        }

        /* ===== CARD ===== */
        .card {
            border-radius: 12px;
            border: 1px solid var(--border);
        }

        /* ===== ALERT ===== */
        .alert-success {
            border-radius: 10px;
        }

        /* ===== BUTTON PRIMARY ===== */
        .btn-primary {
            background-color: var(--primary);
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <i class="fa-solid fa-graduation-cap me-2"></i>
            SIM MAGANG
        </div>

        <div class="nav-container">
            <ul class="nav flex-column">

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('*/dashboard') ? 'active' : '' }}"
                       href="{{ url(Auth::user()->role . '/dashboard') }}">
                        <i class="fa-solid fa-gauge"></i> Dashboard
                    </a>
                </li>

                @if (Auth::user()->role == 'admin')
                <div class="section-label">Management</div>

                <a class="nav-link {{ Request::is('admin/dosen*') ? 'active' : '' }}"
                   href="{{ route('admin.dosen.index') }}">
                    <i class="fa-solid fa-user-tie"></i> Data Dosen
                </a>

                <a class="nav-link {{ Request::is('admin/mahasiswa*') ? 'active' : '' }}"
                   href="{{ route('admin.mahasiswa.index') }}">
                    <i class="fa-solid fa-users"></i> Data Mahasiswa
                </a>

                <a class="nav-link {{ Request::is('admin/pengajuan*') ? 'active' : '' }}"
                   href="{{ route('admin.pengajuan.index') }}">
                    <i class="fa-solid fa-file-circle-check"></i> Persetujuan Magang
                </a>

                <a class="nav-link {{ Request::is('admin/sidang*') ? 'active' : '' }}"
                   href="{{ route('admin.sidang.index') }}">
                    <i class="fa-solid fa-graduation-cap"></i> Daftar Sidang
                </a>
                @endif

                @if (Auth::user()->role == 'dosen')
                <div class="section-label">Monitoring</div>

                <a class="nav-link {{ Request::is('dosen/monitoring*') ? 'active' : '' }}"
                   href="{{ route('dosen.monitoring.index') }}">
                    <i class="fa-solid fa-chart-line"></i> Progress Siswa
                </a>

                <a class="nav-link {{ Request::is('dosen/penilaian*') ? 'active' : '' }}"
                   href="{{ route('dosen.penilaian.index') }}">
                    <i class="fa-solid fa-award"></i> Input Penilaian
                </a>
                @endif

                @if (Auth::user()->role == 'mahasiswa')
                <div class="section-label">My Activity</div>

                <a class="nav-link {{ Request::is('mahasiswa/pengajuan*') ? 'active' : '' }}"
                   href="{{ route('mahasiswa.pengajuan.index') }}">
                    <i class="fa-solid fa-file-signature"></i> Pengajuan
                </a>

                <a class="nav-link {{ Request::is('mahasiswa/logbook*') ? 'active' : '' }}"
                   href="{{ route('mahasiswa.logbook.index') }}">
                    <i class="fa-solid fa-book"></i> Logbook Harian
                </a>

                <a class="nav-link {{ Request::is('mahasiswa/sidang*') ? 'active' : '' }}"
                   href="{{ route('mahasiswa.sidang.index') }}">
                    <i class="fa-solid fa-graduation-cap"></i> Daftar Sidang
                </a>
                @endif

            </ul>
        </div>

        <div class="px-3">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <nav class="top-nav">
            <h1 class="page-title">@yield('title')</h1>

            <div class="user-profile-btn">
                <div class="avatar-box">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="fw-semibold" style="font-size: 0.85rem;">
                        {{ Auth::user()->name }}
                    </div>
                    <small class="text-muted" style="font-size: 0.75rem;">
                        {{ ucfirst(Auth::user()->role) }}
                    </small>
                </div>
            </div>
        </nav>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @yield('content')

    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>