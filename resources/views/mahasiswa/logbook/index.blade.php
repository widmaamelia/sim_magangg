@extends('layouts.app')

@section('title', 'Logbook Harian')

@section('content')
    <div class="container-fluid px-0">

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-header bg-white border-0 px-4 py-4 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-semibold mb-1">Logbook Harian</h4>
                    <p class="text-muted mb-0 small">
                        Catatan kegiatan magang harian Amelia
                    </p>
                </div>

                <a href="{{ route('mahasiswa.logbook.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                    <i class="fas fa-plus me-2"></i>Tambah Logbook
                </a>
            </div>

            <div class="card-body px-4 pb-4">

                @if (session('success'))
                    <div class="alert alert-success border-0 rounded-3 shadow-sm d-flex align-items-center">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @forelse($logbooks as $log)
                    <div class="logbook-item mb-3 p-3 rounded-4 border border-light">

                        <div class="d-flex justify-content-between align-items-start">

                            <div class="flex-grow-1">
                                <span class="text-muted small fw-medium">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ \Carbon\Carbon::parse($log->tanggal)->format('d F Y') }}
                                </span>

                                <p class="fw-medium text-dark mb-2 mt-1">
                                    {{ $log->kegiatan }}
                                </p>

                                <div class="d-flex align-items-center gap-2 mb-2">
                                    @if($log->status == 'acc')
                                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 border border-success-subtle">
                                            <i class="fas fa-check-circle me-1"></i>Disetujui Dosen
                                        </span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2 border border-warning-subtle">
                                            <i class="fas fa-clock me-1"></i>Menunggu Review
                                        </span>
                                    @endif

                                    @if($log->file_lampiran)
                                        <a href="{{ asset('storage/' . $log->file_lampiran) }}" target="_blank" 
                                           class="badge bg-info-subtle text-info rounded-pill px-3 py-2 border border-info-subtle text-decoration-none">
                                            <i class="fas fa-paperclip me-1"></i>Lihat Lampiran
                                        </a>
                                    @endif
                                </div>

                                @if($log->komentar_dosen)
                                    <div class="mt-3 p-3 bg-light border-start border-4 border-primary rounded-3">
                                        <small class="text-muted d-block mb-1 fw-bold">
                                            <i class="fas fa-comment-dots me-1"></i>Catatan Pembimbing:
                                        </small>
                                        <p class="mb-0 small text-dark fst-italic">"{{ $log->komentar_dosen }}"</p>
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex gap-2 ms-3">
                                <a href="{{ route('mahasiswa.logbook.show', $log->id) }}"
                                    class="btn btn-sm btn-white border shadow-sm" title="Detail">
                                    <i class="fas fa-eye text-info"></i>
                                </a>

                                {{-- Hanya bisa edit/hapus jika belum di-ACC dosen --}}
                                @if($log->status != 'acc')
                                    <a href="{{ route('mahasiswa.logbook.edit', $log->id) }}"
                                        class="btn btn-sm btn-white border shadow-sm" title="Edit">
                                        <i class="fas fa-edit text-warning"></i>
                                    </a>

                                    <form action="{{ route('mahasiswa.logbook.destroy', $log->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-white border shadow-sm" title="Hapus"
                                            onclick="return confirm('Amelia, yakin ingin menghapus logbook ini?')">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>

                        </div>
                    </div>

                @empty
                    <div class="text-center py-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076478.png" width="120" class="mb-3 opacity-50"
                            alt="Empty">
                        <h6 class="fw-semibold mb-1">Belum Ada Logbook</h6>
                        <p class="text-muted small">
                            Amelia, kamu belum mencatat kegiatan magang di {{ $magang->nama_perusahaan ?? 'perusahaan' }}.
                        </p>
                    </div>
                @endforelse

            </div>
        </div>

    </div>

    <style>
        .logbook-item {
            background: #ffffff;
            transition: all .3s ease;
        }

        .logbook-item:hover {
            border-color: #0d6efd !important;
            transform: translateY(-3px);
            box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .05) !important;
        }

        .btn-white {
            background: #fff;
        }

        .bg-success-subtle { background-color: #e6fcf5; }
        .bg-warning-subtle { background-color: #fff9db; }
        .bg-info-subtle { background-color: #e7f5ff; }
    </style>
@endsection