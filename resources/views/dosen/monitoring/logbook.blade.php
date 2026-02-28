@extends('layouts.app')

@section('title', 'Detail Logbook Mahasiswa')

@section('content')
    <div class="mb-4">
        <a href="{{ route('dosen.monitoring.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Monitoring
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-white py-4 border-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold text-primary">Review Logbook Harian</h5>
                    <small class="text-muted">Mahasiswa: <strong>{{ $magang->mahasiswa->name }}</strong> | NIM: <strong>{{ $magang->mahasiswa->identity_number }}</strong></small>
                </div>
                <span class="badge bg-info text-white rounded-pill px-3">{{ $logbooks->count() }} Entri</span>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" width="180">Tanggal</th>
                            <th>Aktivitas / Kegiatan</th>
                            <th width="350" class="pe-4">Review Dosen</th> {{-- Kolom Baru --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logbooks as $l)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ date('d M Y', strtotime($l->tanggal)) }}</div>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($l->tanggal)->diffForHumans() }}</small>
                                    
                                    @if($l->file_lampiran)
                                        <div class="mt-2">
                                            <a href="{{ asset('storage/'.$l->file_lampiran) }}" target="_blank" class="btn btn-xs btn-outline-primary py-0 px-2" style="font-size: 10px;">
                                                <i class="fas fa-paperclip"></i> Lampiran
                                            </a>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-wrap" style="min-width: 250px;">
                                    <p class="mb-1 text-dark">{{ $l->kegiatan }}</p>
                                    @if($l->status == 'acc')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">
                                            <i class="fas fa-check-circle me-1"></i> Terverifikasi
                                        </span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill">
                                            <i class="fas fa-clock me-1"></i> Menunggu
                                        </span>
                                    @endif
                                </td>
                                <td class="pe-4">
                                    {{-- FORM REVIEW DOSEN --}}
                                    <form action="{{ route('dosen.logbook.updateStatus', $l->id) }}" method="POST">
                                        @csrf
                                        <div class="input-group input-group-sm mb-2 shadow-sm">
                                            <input type="text" name="komentar_dosen" class="form-control" 
                                                   placeholder="Beri masukan..." value="{{ $l->komentar_dosen }}">
                                            <button type="submit" name="status" value="acc" class="btn btn-success" title="ACC Laporan">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </div>
                                        @if($l->status == 'acc')
                                            <button type="submit" name="status" value="pending" class="btn btn-link btn-sm text-danger text-decoration-none p-0">
                                                <small><i class="fas fa-undo"></i> Batalkan ACC</small>
                                            </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">
                                    <i class="fas fa-notes-medical fa-3x mb-3 d-block opacity-25"></i>
                                    Belum ada catatan logbook dari {{ $magang->mahasiswa->name }}.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<style>
    .bg-success-subtle { background-color: #e6fcf5; }
    .bg-warning-subtle { background-color: #fff9db; }
    .btn-xs { padding: 1px 5px; font-size: 12px; line-height: 1.5; border-radius: 3px; }
</style>