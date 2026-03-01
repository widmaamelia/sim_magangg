@extends('layouts.app')

@section('title', 'Dashboard Dosen')

@section('content')
<div class="container">

    {{-- HEADER --}}
    

    {{-- STATISTICS CARDS --}}
    <div class="row g-4">

        {{-- TOTAL BIMBINGAN --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-primary bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-users text-primary fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Mahasiswa</h6>
                        <h3 class="fw-bold mb-0">{{ $total_bimbingan }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- DISETUJUI --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-success bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-check-circle text-success fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Magang Disetujui</h6>
                        <h3 class="fw-bold mb-0">
                            {{ $magangs->where('status','disetujui')->count() }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- PENDING --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-warning bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-clock text-warning fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Menunggu Persetujuan</h6>
                        <h3 class="fw-bold mb-0">
                            {{ $magangs->where('status','pending')->count() }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- TABEL --}}
    <div class="card shadow-sm border-0 mt-5">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">
                <i class="fas fa-list me-2 text-primary"></i>
                Daftar Mahasiswa Bimbingan
            </h5>
            <span class="badge bg-primary">
                {{ $total_bimbingan }} Mahasiswa
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50" class="text-center">No</th>
                            <th>Mahasiswa</th>
                            <th>Perusahaan</th>
                            <th>Periode</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($magangs as $magang)
                            <tr>
                                <td class="text-center fw-semibold">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $magang->mahasiswa->name ?? '-' }}
                                    </div>
                                    <small class="text-muted">
                                        NIM: {{ $magang->mahasiswa->identity_number ?? '-' }}
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        {{ $magang->nama_perusahaan }}
                                    </span>
                                </td>

                                <td>
                                    <small class="text-muted">
                                        {{ date('d M Y', strtotime($magang->tanggal_mulai)) }}
                                        -
                                        {{ date('d M Y', strtotime($magang->tanggal_selesai)) }}
                                    </small>
                                </td>

                                <td class="text-center">
                                    @if($magang->status == 'pending')
                                        <span class="badge bg-warning text-dark px-3 py-2">
                                            <i class="fas fa-clock me-1"></i> Pending
                                        </span>
                                    @elseif($magang->status == 'disetujui')
                                        <span class="badge bg-success px-3 py-2">
                                            <i class="fas fa-check-circle me-1"></i> Disetujui
                                        </span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2">
                                            <i class="fas fa-times-circle me-1"></i> Ditolak
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                                    Belum ada mahasiswa bimbingan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection