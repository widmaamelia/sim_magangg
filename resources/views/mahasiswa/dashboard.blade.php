@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="container">

    {{-- HEADER --}}
    

    {{-- STATISTIK --}}
    <div class="row g-4">

        {{-- STATUS --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-info bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-briefcase text-info fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Status Magang</h6>
                        <h5 class="fw-bold mb-0">
                            {{ $magang->status ?? 'Belum Mengajukan' }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- PERUSAHAAN --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-primary bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-building text-primary fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Perusahaan</h6>
                        <h6 class="fw-bold mb-0">
                            {{ $magang->nama_perusahaan ?? '-' }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>

        {{-- DOSEN --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-success bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-user-tie text-success fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Dosen Pembimbing</h6>
                        <h6 class="fw-bold mb-0">
                            {{ $magang->dosen->name ?? 'Belum Ditentukan' }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- DETAIL TABEL --}}
    <div class="card shadow-sm border-0 mt-5">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">
                <i class="fas fa-info-circle me-2 text-primary"></i>
                Detail Pengajuan Magang
            </h5>
        </div>

        <div class="card-body p-0">

            @if($magang)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <tbody>
                            <tr>
                                <th width="30%">Nama Perusahaan</th>
                                <td>{{ $magang->nama_perusahaan }}</td>
                            </tr>
                            <tr>
                                <th>Alamat Perusahaan</th>
                                <td>{{ $magang->alamat_perusahaan }}</td>
                            </tr>
                            <tr>
                                <th>Periode Magang</th>
                                <td>
                                    {{ date('d M Y', strtotime($magang->tanggal_mulai)) }}
                                    -
                                    {{ date('d M Y', strtotime($magang->tanggal_selesai)) }}
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($magang->status == 'pending')
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-clock me-1"></i> Menunggu
                                        </span>
                                    @elseif($magang->status == 'disetujui')
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i> Disetujui
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times-circle me-1"></i> Ditolak
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                    <h6 class="mb-3">Belum ada pengajuan magang.</h6>
                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-1"></i> Ajukan Magang
                    </a>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection