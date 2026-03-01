@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid py-4">

    {{-- <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Dashboard Overview</h4>
    </div> --}}

    <!-- Statistik -->
    <div class="row g-4 mb-4">

        <!-- Total Dosen -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total Dosen</p>
                        <h3 class="fw-bold mb-0">{{ $total_dosen }}</h3>
                    </div>
                    <div class="bg-primary text-white p-3 rounded-circle">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Mahasiswa -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total Mahasiswa</p>
                        <h3 class="fw-bold mb-0">{{ $total_mahasiswa }}</h3>
                    </div>
                    <div class="bg-success text-white p-3 rounded-circle">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pengajuan -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total Pengajuan</p>
                        <h3 class="fw-bold mb-0">{{ $total_pengajuan }}</h3>
                    </div>
                    <div class="bg-warning text-white p-3 rounded-circle">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Charts -->
    <div class="row g-4">

        <!-- Chart Pengajuan per Bulan -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-3 p-3">
                <h6 class="fw-bold mb-3">Pengajuan per Bulan</h6>
                <canvas id="pengajuanChart"></canvas>
            </div>
        </div>

        <!-- Chart Perbandingan -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-3 p-3">
                <h6 class="fw-bold mb-3">Perbandingan Dosen & Mahasiswa</h6>
                <canvas id="userChart"></canvas>
            </div>
        </div>

    </div>
</div>

<!-- Chart JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const pengajuanData = @json($pengajuan_per_bulan);

    // Chart Pengajuan per Bulan
    new Chart(document.getElementById('pengajuanChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Pengajuan',
                data: pengajuanData,
                borderColor: '#1E3A8A',
                backgroundColor: 'rgba(30,58,138,0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });

    // Chart Perbandingan
    new Chart(document.getElementById('userChart'), {
        type: 'bar',
        data: {
            labels: ['Dosen', 'Mahasiswa'],
            datasets: [{
                data: [{{ $total_dosen }}, {{ $total_mahasiswa }}],
                backgroundColor: ['#1E3A8A', '#16A34A']
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });
</script>
@endsection