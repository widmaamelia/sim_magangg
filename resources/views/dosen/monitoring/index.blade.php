@extends('layouts.app')

@section('title', 'Monitoring Mahasiswa')

@section('content')

<style>
    :root {
        --soft-bg: #f8fafc;
        --soft-border: #e5e7eb;
        --primary-soft: #eef2ff;
        --primary-color: #4f46e5;
    }

    body {
        background: #f1f5f9;
    }

    .table-container {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .table thead th {
        background: var(--soft-bg);
        font-size: .7rem;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: #64748b;
        padding: 1.2rem 1rem;
        border: none;
    }

    .table td {
        padding: 1.2rem 1rem;
        border-bottom: 1px solid var(--soft-border);
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background: #f9fafb;
    }

    .student-name {
        font-weight: 600;
        color: #0f172a;
    }

    .student-nim {
        font-size: .8rem;
        color: #94a3b8;
    }

    .badge-kelas {
        font-size: .65rem;
        margin-top: 4px;
        background: var(--primary-soft);
        color: var(--primary-color);
        border: none;
        font-weight: 500;
    }

    .action-group {
        display: flex;
        justify-content: flex-end;
        gap: 6px;
    }

    .btn-action {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        padding: 0;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        color: #64748b;
        transition: all .2s ease;
    }

    .btn-action:hover {
        background: #f1f5f9;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(15, 23, 42, 0.08);
    }
</style>

<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            {{-- <h3 class="fw-bold mb-1 text-dark">Monitoring Mahasiswa</h3> --}}
            <p class="text-muted small mb-0">
                Total <span class="fw-bold text-primary">{{ $mahasiswas->count() }}</span> Mahasiswa Bimbingan
            </p>
        </div>

        <div class="input-group shadow-sm" style="max-width:280px;">
            <span class="input-group-text bg-white border-end-0 text-muted">
                <i class="fas fa-search"></i>
            </span>
            <input type="text" id="searchInput"
                   class="form-control border-start-0 ps-0"
                   placeholder="Cari nama mahasiswa…">
        </div>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="table-container">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Mahasiswa</th>
                        <th>Perusahaan</th>
                        <th class="text-center">Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($mahasiswas as $m)
                    <tr>
                        {{-- MAHASISWA --}}
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="width:40px;height:40px;background:#eef2ff;color:#4f46e5;">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <div>
                                    <div class="student-name">
                                        {{ $m->mahasiswa->name }}
                                    </div>
                                    <div class="student-nim">
                                        {{ $m->mahasiswa->identity_number }}
                                    </div>
                                    <span class="badge badge-kelas px-2 py-1 rounded-pill">
                                        Kelas {{ $m->mahasiswa->kelas ?? '-' }}
                                    </span>
                                </div>
                            </div>
                        </td>

                        {{-- PERUSAHAAN --}}
                        <td>
                            <div class="fw-semibold text-dark text-capitalize">
                                {{ $m->nama_perusahaan }}
                            </div>
                            <small class="text-muted">
                                Lokasi Magang
                            </small>
                        </td>

                        {{-- STATUS NILAI --}}
                        <td class="text-center">
                           {{-- Kita cek melalui relasi 'nilai' yang sudah kamu buat di model Magang --}}
    @if ($m->nilai) 
        <span class="badge bg-success bg-opacity-10 text-success px-3 py-1 rounded-pill">
            <i class="fas fa-check-circle me-1"></i>Dinilai 
        </span>
    @else
        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-1 rounded-pill">
            <i class="fas fa-clock me-1"></i> Belum Dinilai
        </span>
    @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="pe-4 text-end">
                            <div class="action-group">

                                {{-- LOGBOOK --}}
                                <a href="{{ route('dosen.monitoring.logbook', $m->id) }}"
                                   class="btn-action text-primary"
                                   title="Lihat Logbook">
                                    <i class="fas fa-book-open"></i>
                                </a>

                                {{-- INPUT NILAI --}}
                                @if ($m->angka_nilai)
                                    <button class="btn-action text-success" disabled title="Sudah Dinilai">
                                        <i class="fas fa-check"></i>
                                    </button>
                                @else
                                    <a href="{{ route('dosen.penilaian.create', $m->id) }}"
                                       class="btn-action text-warning"
                                       title="Beri Nilai">
                                        <i class="fas fa-star"></i>
                                    </a>
                                @endif

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            Belum ada mahasiswa bimbingan.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- SEARCH SCRIPT --}}
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            let name = row.querySelector('.student-name')?.textContent.toLowerCase() || '';
            row.style.display = name.includes(filter) ? '' : 'none';
        });
    });
</script>

@endsection