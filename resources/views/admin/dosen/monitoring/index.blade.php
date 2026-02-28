@extends('layouts.app')

@section('title', 'Monitoring Mahasiswa')

@section('content')

<style>
    /* Desain Container & Tabel Premium */
    .table-container {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .table thead th {
        background: #f8fafc;
        font-size: .7rem;
        text-transform: uppercase;
        color: #64748b;
        padding: 1.2rem 1rem;
        border: none;
    }

    /* Styling Tombol Aksi */
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        border: 1px solid #e5e7eb;
        transition: all .2s ease;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    /* Custom Modal Style agar tidak berantakan */
    .modal-content {
        border-radius: 20px;
        border: none;
    }
    .modal-header {
        border-bottom: none;
        padding: 1.5rem 1.5rem 0.5rem;
    }
    .modal-footer {
        border-top: none;
        padding: 0.5rem 1.5rem 1.5rem;
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0 text-dark">Monitoring Mahasiswa</h3>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container shadow-sm border-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Mahasiswa</th>
                        <th>Perusahaan</th>
                        <th class="text-center">Status Nilai</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswas as $m)
                        <tr>
                            <td class="ps-4">
                                <div class="student-name fw-bold">{{ $m->mahasiswa->name }}</div>
                                <div class="student-nim text-muted small">{{ $m->mahasiswa->identity_number }}</div>
                            </td>
                            <td>{{ $m->nama_perusahaan }}</td>
                            <td class="text-center">
                                @if ($m->angka_nilai)
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Dinilai</span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Belum Dinilai</span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('dosen.monitoring.logbook', $m->id) }}" class="btn-action text-primary" title="Lihat Logbook">
                                        <i class="fas fa-book-open"></i>
                                    </a>
                                    {{-- Tombol Pemicu Modal --}}
                                    <button type="button" class="btn-action text-warning" data-bs-toggle="modal" data-bs-target="#modalNilai{{ $m->id }}">
                                        <i class="fas fa-star"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalNilai{{ $m->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form action="{{ route('dosen.penilaian.store') }}" method="POST" class="modal-content shadow-lg">
                                    @csrf
                                    <input type="hidden" name="magang_id" value="{{ $m->id }}">
                                    
                                    <div class="modal-header">
                                        <h5 class="fw-bold text-dark"><i class="fas fa-star text-warning me-2"></i>Memberikan penilaian untuk:</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    
                                    <div class="modal-body px-4 text-center">
                                        <h2 class="fw-bold text-primary mb-4">{{ $m->mahasiswa->name }}</h2>
                                        
                                        <div class="mb-4 bg-light p-4 rounded-4">
                                            <label class="form-label fw-bold text-secondary mb-3">Nilai Akhir (0-100)</label>
                                            {{-- Input Nilai Besar di Tengah --}}
                                            <input type="number" name="angka_nilai" class="form-control form-control-lg text-center fw-bold border-0 shadow-none" 
                                                   placeholder="0" min="0" max="100" required style="font-size: 3rem; background: transparent;">
                                        </div>

                                        <div class="text-start mb-3">
                                            <label class="form-label fw-bold text-muted small">CATATAN PEMBIMBING</label>
                                            <textarea name="keterangan" class="form-control border-light" rows="3" placeholder="Sangat aktif dan disiplin..."></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-warning px-5 fw-bold text-white rounded-pill shadow-sm">Simpan Nilai</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr><td colspan="4" class="text-center py-5">Belum ada mahasiswa.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection