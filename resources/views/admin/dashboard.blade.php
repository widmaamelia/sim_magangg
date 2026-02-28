@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container-fluid py-4">

        <!-- Header Section -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Dashboard Overview</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>

        <!-- Stats Cards with Animated Counters -->
        <div class="row g-4 mb-4">
            <!-- Card Total Dosen -->
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm h-100 border-0 rounded-4 gradient-primary">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-white fw-bold mb-1">Total Dosen</h6>
                            <h2 class="text-white fw-bold mb-0"><span class="counter"
                                    data-target="{{ $total_dosen }}">0</span></h2>
                        </div>
                        <div class="icon-circle bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="fas fa-user-tie fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Total Mahasiswa -->
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm h-100 border-0 rounded-4 gradient-success">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-white fw-bold mb-1">Total Mahasiswa</h6>
                            <h2 class="text-white fw-bold mb-0"><span class="counter"
                                    data-target="{{ $total_mahasiswa }}">0</span></h2>
                        </div>
                        <div class="icon-circle bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="fas fa-users fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Total Pengajuan -->
            <div class="col-xl-4 col-md-12">
                <div class="card shadow-sm h-100 border-0 rounded-4 gradient-warning">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-white fw-bold mb-1">Total Pengajuan</h6>
                            <h2 class="text-white fw-bold mb-0"><span class="counter"
                                    data-target="{{ $total_pengajuan }}">0</span></h2>
                        </div>
                        <div class="icon-circle bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="fas fa-file-alt fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card shadow-sm rounded-4 p-3">
                    <h6 class="fw-bold mb-3">Pengajuan per Bulan</h6>
                    <canvas id="pengajuanChart" height="200"></canvas>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm rounded-4 p-3">
                    <h6 class="fw-bold mb-3">Perbandingan Dosen vs Mahasiswa</h6>
                    <canvas id="userChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        .gradient-primary {
            background: linear-gradient(90deg, #4e73df, #224abe);
        }

        .gradient-success {
            background: linear-gradient(90deg, #1cc88a, #17a673);
        }

        .gradient-warning {
            background: linear-gradient(90deg, #f6c23e, #dda20a);
        }

        .icon-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
        }
    </style>

    <!-- Chart.js & Counter JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Animated Counters
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = Math.ceil(target / 100); // smooth increment
                if (count < target) {
                    counter.innerText = count + increment;
                    setTimeout(updateCount, 20);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });

        // Charts
        const pengajuanCtx = document.getElementById('pengajuanChart').getContext('2d');
        let pengajuanChart = new Chart(pengajuanCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pengajuan',
                    data: [12, 19, 8, 15, 10, 20, 18, 23, 17, 25, 22, 30],
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78,115,223,0.2)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                }
            }
        });

        const userCtx = document.getElementById('userChart').getContext('2d');
        let userChart = new Chart(userCtx, {
            type: 'bar',
            data: {
                labels: ['Dosen', 'Mahasiswa'],
                datasets: [{
                    label: 'Jumlah',
                    data: [{{ $total_dosen }}, {{ $total_mahasiswa }}],
                    backgroundColor: ['#4e73df', '#1cc88a']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                }
            }
        });

        // Live Update Example (simulasi)
        setInterval(() => {
            fetch('/api/dashboard-stats') // endpoint Laravel yang mengembalikan JSON stats
                .then(res => res.json())
                .then(data => {
                    // Update counters
                    counters[0].innerText = data.total_dosen;
                    counters[1].innerText = data.total_mahasiswa;
                    counters[2].innerText = data.total_pengajuan;

                    // Update charts
                    pengajuanChart.data.datasets[0].data = data.pengajuan_per_bulan;
                    pengajuanChart.update();

                    userChart.data.datasets[0].data = [data.total_dosen, data.total_mahasiswa];
                    userChart.update();
                });
        }, 10000); // update tiap 10 detik
    </script>
@endsection
