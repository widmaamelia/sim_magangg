@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <div class="card border-0 shadow-sm rounded-4">

                <!-- Header -->
                <div class="card-header bg-white border-0 px-4 pt-4">
                    <h4 class="fw-semibold mb-1">Status Magang</h4>
                    <p class="text-muted mb-0">
                        Informasi pengajuan magang kamu saat ini
                    </p>
                </div>

                <div class="card-body px-4 pb-4">

                    @if ($magang)

                        <!-- Info Row -->
                        <div class="row g-4">

                            <!-- Perusahaan -->
                            <div class="col-md-4">
                                <div class="info-card">
                                    <span class="info-label">Perusahaan</span>
                                    <h6 class="info-value">
                                        {{ $magang->nama_perusahaan }}
                                    </h6>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-4">
                                <div class="info-card">
                                    <span class="info-label">Status Pengajuan</span>

                                    @if ($magang->status == 'pending')
                                        <span class="status-pill warning">Menunggu Persetujuan</span>
                                    @elseif($magang->status == 'disetujui')
                                        <span class="status-pill success">Disetujui</span>
                                    @else
                                        <span class="status-pill danger">Ditolak</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Dosen -->
                            <div class="col-md-4">
                                <div class="info-card">
                                    <span class="info-label">Dosen Pembimbing</span>
                                    <h6 class="info-value">
                                        {{ $magang->dosen->name ?? 'Belum Ditentukan' }}
                                    </h6>
                                </div>
                            </div>

                        </div>

                        <!-- Divider -->
                        <hr class="my-4">

                        <!-- Progress -->
                        <div>
                            <span class="text-muted small">Progress Pengajuan</span>
                            <div class="progress mt-2 rounded-pill" style="height: 8px;">
                                <div class="progress-bar 
                            @if ($magang->status == 'pending') bg-warning
                            @elseif($magang->status == 'disetujui') bg-success
                            @else bg-danger @endif"
                                    style="width:
                                @if ($magang->status == 'pending') 50%
                                @elseif($magang->status == 'disetujui') 100%
                                @else 100% @endif">
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076478.png" width="120" class="mb-4"
                                alt="No Data">

                            <h5 class="fw-semibold mb-2">Belum Ada Pengajuan Magang</h5>
                            <p class="text-muted mb-4">
                                Silakan ajukan magang untuk memulai proses bimbingan.
                            </p>

                            <a href="#" class="btn btn-primary px-4 rounded-pill">
                                Ajukan Magang
                            </a>
                        </div>

                    @endif

                </div>
            </div>

        </div>
    </div>

    <!-- Style Halus -->
    <style>
        .info-card {
            background: #f9fafb;
            border-radius: 16px;
            padding: 16px 18px;
            height: 100%;
        }

        .info-label {
            font-size: 13px;
            color: #6c757d;
            display: block;
            margin-bottom: 6px;
        }

        .info-value {
            font-weight: 600;
            margin: 0;
            color: #212529;
        }

        .status-pill {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
        }

        .status-pill.warning {
            background: #fff3cd;
            color: #856404;
        }

        .status-pill.success {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-pill.danger {
            background: #f8d7da;
            color: #842029;
        }
    </style>
@endsection
