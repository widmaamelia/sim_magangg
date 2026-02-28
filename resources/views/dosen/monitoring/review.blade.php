@extends('layouts.app')

@section('title', 'Review Logbook Mahasiswa')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex align-items-center justify-content-between mb-4 bg-white p-4 rounded-4 shadow-sm">
        <div class="d-flex align-items-center">
            <a href="{{ route('dosen.monitoring.index') }}" class="btn btn-light rounded-circle me-3">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h4 class="fw-bold mb-1 text-dark">Review Logbook Mahasiswa</h4>
                <p class="text-muted mb-0">
                    Mahasiswa: <span class="fw-semibold text-primary">{{ $magang->mahasiswa->name }}</span> | 
                    NIM: <span class="fw-semibold text-primary">{{ $magang->mahasiswa->identity_number }}</span>
                </p>
            </div>
        </div>
        <div class="text-end">
            <span class="badge bg-info-subtle text-info border border-info-subtle px-3 py-2 rounded-pill">
                <i class="fas fa-building me-1"></i> {{ $magang->nama_perusahaan }}
            </span>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4 d-flex align-items-center">
            <i class="fas fa-check-circle me-2 fa-lg"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4 text-center">
                    <div class="bg-primary-subtle text-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                        <i class="fas fa-chart-line fa-2x"></i>
                    </div>
                    <h6 class="fw-bold">Statistik Laporan</h6>
                    <div class="row mt-3">
                        <div class="col-6">
                            <h5 class="mb-0 fw-bold">{{ $logbooks->count() }}</h5>
                            <small class="text-muted">Total</small>
                        </div>
                        <div class="col-6">
                            <h5 class="mb-0 fw-bold text-success">{{ $logbooks->where('status', 'acc')->count() }}</h5>
                            <small class="text-muted">Di-ACC</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            @forelse($logbooks as $log)
                <div class="card border-0 shadow-sm rounded-4 mb-3 border-start border-5 {{ $log->status == 'acc' ? 'border-success' : 'border-warning' }}">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h6 class="fw-bold text-dark mb-1">
                                    <i class="far fa-calendar-alt me-2 text-primary"></i>
                                    {{ \Carbon\Carbon::parse($log->tanggal)->format('d F Y') }}
                                </h6>
                                <span class="badge {{ $log->status == 'acc' ? 'bg-success' : 'bg-warning-subtle text-warning' }} px-3 py-2 rounded-pill">
                                    <i class="fas {{ $log->status == 'acc' ? 'fa-check-circle' : 'fa-clock' }} me-1"></i>
                                    {{ $log->status == 'acc' ? 'Sudah Disetujui' : 'Menunggu Review' }}
                                </span>
                            </div>
                            @if($log->file_lampiran)
                                <a href="{{ asset('storage/'.$log->file_lampiran) }}" target="_blank" class="btn btn-outline-info btn-sm rounded-pill px-3">
                                    <i class="fas fa-paperclip me-1"></i> Lihat Bukti
                                </a>
                            @endif
                        </div>

                        <div class="bg-light p-3 rounded-3 mb-4">
                            <p class="mb-0 text-dark">{{ $log->kegiatan }}</p>
                        </div>

                        <form action="{{ route('dosen.logbook.updateStatus', $log->id) }}" method="POST">
                            @csrf
                            <div class="row align-items-end">
                                <div class="col-lg-9 col-md-8 mb-3 mb-lg-0">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Tulis Komentar / Diskusi:</label>
                                    <textarea name="komentar_dosen" class="form-control border-light shadow-sm" rows="2" 
                                              placeholder="Berikan masukan untuk bimbingan Amelia...">{{ $log->komentar_dosen }}</textarea>
                                </div>
                                <div class="col-lg-3 col-md-4">
                                    <div class="d-grid gap-2">
                                        <button type="submit" name="status" value="acc" class="btn btn-success shadow-sm fw-bold">
                                            <i class="fas fa-check me-2"></i> ACC Laporan
                                        </button>
                                        @if($log->status == 'acc')
                                            <button type="submit" name="status" value="pending" class="btn btn-outline-danger btn-sm border-0">
                                                Batalkan ACC
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 bg-white rounded-4 shadow-sm border border-dashed">
                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076478.png" width="100" class="mb-3 opacity-25">
                    <h6 class="text-muted italic">Amelia belum mengisi logbook untuk tanggal apapun.</h6>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .bg-primary-subtle { background-color: #e7f1ff; }
    .bg-warning-subtle { background-color: #fff9db; }
    .card { transition: all 0.3s ease; }
    .card:hover { transform: scale(1.01); }
</style>
@endsection