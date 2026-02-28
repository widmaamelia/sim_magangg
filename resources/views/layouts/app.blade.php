<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM Magang - @yield('title')</title>

    <!-- Google Fonts: Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            /* Palette Warna Gen Z - Vibrant & Fresh */
            --glass-bg: rgba(255, 255, 255, 0.7);
            --primary-gradient: linear-gradient(135deg, #8B5CF6 0%, #6366F1 100%);
            --secondary-gradient: linear-gradient(135deg, #3B82F6 0%, #2DD4BF 100%);
            --bg-body: #F8FAFC;
            --sidebar-width: 280px;
            --text-main: #1E293B;
            --text-muted: #64748B;
            --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* Sidebar Styling - Floating Style */
        .sidebar {
            width: var(--sidebar-width);
            height: calc(100vh - 40px);
            background: white;
            border-radius: 24px;
            margin: 20px;
            position: fixed;
            box-shadow: var(--card-shadow);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .sidebar-brand {
            padding: 30px;
            font-weight: 800;
            font-size: 1.4rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-brand i {
            -webkit-text-fill-color: #6366F1;
        }

        .nav-container {
            padding: 0 15px;
            flex-grow: 1;
            overflow-y: auto;
        }

        .section-label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #94A3B8;
            margin: 25px 0 10px 15px;
        }

        .nav-link {
            color: var(--text-muted);
            padding: 12px 18px;
            border-radius: 14px;
            margin-bottom: 4px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-link i {
            font-size: 1.2rem;
            opacity: 0.7;
        }

        .nav-link:hover {
            color: #6366F1;
            background: rgba(99, 102, 241, 0.05);
            padding-left: 22px;
        }

        .nav-link.active {
            background: var(--primary-gradient);
            color: white !important;
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.4);
        }

        .nav-link.active i {
            opacity: 1;
        }

        /* Main Content Styling */
        .main-content {
            margin-left: calc(var(--sidebar-width) + 40px);
            padding: 20px 40px 40px 0;
        }

        /* Top Navbar - Glassmorphism */
        .top-nav {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            padding: 15px 25px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--card-shadow);
        }

        .user-profile-btn {
            background: white;
            border: 1px solid #F1F5F9;
            padding: 6px 16px 6px 6px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.3s;
            cursor: pointer;
        }

        .user-profile-btn:hover {
            border-color: #6366F1;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.1);
        }

        .avatar-box {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--secondary-gradient);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
        }

        /* Button & UI Elements */
        .btn-logout {
            background: #FFF1F2;
            color: #E11D48;
            border: none;
            padding: 12px;
            border-radius: 14px;
            width: 100%;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: 0.3s;
            margin-bottom: 20px;
        }

        .btn-logout:hover {
            background: #E11D48;
            color: white;
            transform: translateY(-2px);
        }

        .page-title {
            font-weight: 800;
            font-size: 1.75rem;
            letter-spacing: -0.025em;
            color: var(--text-main);
        }

        /* Dashboard Card Customization */
        .card {
            border: none;
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-up {
            animation: fadeIn 0.5s ease forwards;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #E2E8F0;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <aside class="sidebar d-none d-md-flex">
        <div class="sidebar-brand">
            <i class="fas fa-bolt-lightning fa-lg"></i>
            <span>SIM MAGANG</span>
        </div>

        <div class="nav-container">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('*/dashboard') ? 'active' : '' }}"
                        href="{{ url(Auth::user()->role . '/dashboard') }}">
                        <i class="fa-solid fa-grid-2"></i> Dashboard
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
                    <a class="nav-link {{ Request::is('admin/pengajuan-magang*') ? 'active' : '' }}"
                        href="{{ route('admin.pengajuan.index') }}">
                        <i class="fa-solid fa-circle-check"></i> Persetujuan
                    </a>
                @endif

                @if (Auth::user()->role == 'dosen')
                    <div class="section-label">Monitoring</div>
                    <a class="nav-link {{ Request::is('dosen/monitoring*') ? 'active' : '' }}"
                        href="{{ route('dosen.monitoring.index') }}">
                        <i class="fa-solid fa-chart-pie"></i> Progress Siswa
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
                        <i class="fa-solid fa-book-bookmark"></i> Logbook Harian
                    </a>
                @endif
            </ul>
        </div>

        <div class="px-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="main-content">
        <!-- Top Navigation -->
        <nav class="top-nav animate-up">
            <h1 class="page-title m-0">@yield('title')</h1>

            <div class="user-profile-btn">
                <div class="avatar-box">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="d-none d-sm-block">
                    <div class="fw-bold" style="font-size: 0.85rem; line-height: 1;">{{ Auth::user()->name }}</div>
                    <small class="text-muted" style="font-size: 0.7rem;">{{ ucfirst(Auth::user()->role) }}</small>
                </div>
                <i class="fa-solid fa-chevron-down ms-2 text-muted" style="font-size: 0.7rem;"></i>
            </div>
        </nav>

        <!-- Alerts -->
        <div class="container-fluid p-0 animate-up" style="animation-delay: 0.1s;">
            @if (session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-4 d-flex align-items-center mb-4"
                    role="alert">
                    <i class="fa-solid fa-circle-check me-3 fa-lg"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <!-- Main Content Yield -->
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
