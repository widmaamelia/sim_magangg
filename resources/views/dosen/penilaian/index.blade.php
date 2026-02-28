@extends('layouts.app')

@section('title', 'Daftar Penilaian Mahasiswa')

@section('content')

    {{-- HEADER UTAMA --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="bg-white p-3 rounded shadow-sm border-start border-5 border-primary">
                <h4 class="mb-0 fw-bold text-dark">Daftar Penilaian Mahasiswa</h4>
                <p class="text-muted small mb-0">
                    Kelola nilai mahasiswa bimbingan Amelia secara efisien.
                </p>
            </div>
        </div>
    </div>

    {{-- NOTIFIKASI --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- HEADER TABLE + DOWNLOAD --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-dark mb-0">Kelola Nilai Mahasiswa</h5>

        {{-- DOWNLOAD PDF PER KELAS --}}
        <div class="btn-group shadow-sm">
            <button type="button" class="btn btn-outline-danger dropdown-toggle px-3" data-bs-toggle="dropdown">
                <i class="fas fa-file-pdf me-1"></i>
                Download Nilai
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                <li>
                    <a class="dropdown-item" href="{{ route('dosen.penilaian.export', 'MI3A') }}">
                        Kelas MI3A
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('dosen.penilaian.export', 'MI3B') }}">
                        Kelas MI3B
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('dosen.penilaian.export', 'MI3C') }}">
                        Kelas MI3C
                    </a>
                </li>
            </ul>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted">
                        <tr>
                            <th class="ps-4 py-3">Mahasiswa</th>
                            <th>Perusahaan</th>
                            <th>Nilai</th>
                            <th>Keterangan</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($results as $r)
                            <tr>
                                {{-- MAHASISWA --}}
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">
                                        {{ $r->magang->mahasiswa->name }}
                                    </div>
                                    <div class="small text-muted d-flex align-items-center mt-1">
                                        {{ $r->magang->mahasiswa->identity_number }}
                                        <span class="badge bg-light text-primary border ms-2" style="font-size: .7rem;">
                                            Kelas {{ $r->magang->mahasiswa->kelas ?? '-' }}
                                        </span>
                                    </div>
                                </td>

                                {{-- PERUSAHAAN --}}
                                <td>
                                    <div class="fw-bold text-primary">
                                        {{ $r->magang->nama_perusahaan }}
                                    </div>
                                </td>

                                {{-- NILAI --}}
                                <td>
                                    <span class="badge bg-success px-3">
                                        {{ $r->angka_nilai }}
                                    </span>
                                </td>

                                {{-- KETERANGAN --}}
                                <td>
                                    <small class="text-muted">
                                        {{ $r->keterangan ? Str::limit($r->keterangan, 30) : '-' }}
                                    </small>
                                </td>

                                {{-- AKSI --}}
                                <td class="text-center pe-4">
                                    <div class="d-flex justify-content-center gap-2">

                                        {{-- EDIT --}}
                                        <button class="btn btn-sm btn-warning text-white px-3" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $r->id }}">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </button>

                                        {{-- DELETE --}}
                                        <form action="{{ route('dosen.penilaian.destroy', $r->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Amelia, hapus nilai ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    Belum ada data penilaian.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    @foreach ($results as $r)
        <div class="modal fade" id="editModal{{ $r->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('dosen.penilaian.update', $r->id) }}" method="POST"
                    class="modal-content border-0 shadow">
                    @csrf
                    @method('PUT')

                    <div class="modal-header border-0 bg-primary text-white">
                        <h5 class="modal-title fw-bold">Edit Nilai Mahasiswa</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mahasiswa</label>
                            <input type="text" class="form-control bg-light" value="{{ $r->magang->mahasiswa->name }}"
                                readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nilai Angka</label>
                            <input type="number" name="nilai" class="form-control" value="{{ $r->angka_nilai }}"
                                min="0" max="100" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Keterangan / Evaluasi</label>
                            <textarea name="keterangan" class="form-control" rows="4">{{ $r->keterangan }}</textarea>
                        </div>
                    </div>

                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    {{-- FIX Z-INDEX MODAL --}}
    <style>
        .modal-backdrop {
            z-index: 1040 !important;
        }

        .modal {
            z-index: 1050 !important;
        }
    </style>

@endsection
