@extends('layouts.app')

@section('title', 'Manajemen Data Dosen')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-primary">Daftar Dosen Pembimbing</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modalTambahDosen">
                        <i class="fas fa-plus me-1"></i> Tambah Dosen
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">No</th>
                                    <th>NIP</th>
                                    <th>Nama Dosen</th>
                                    <th>Email</th>
                                    <th width="150" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dosens as $index => $dosen)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><span
                                                class="badge bg-light text-dark border">{{ $dosen->identity_number }}</span>
                                        </td>
                                        <td class="fw-bold">{{ $dosen->name }}</td>
                                        <td>{{ $dosen->email }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <form action="{{ route('admin.dosen.destroy', $dosen->id) }}" method="POST"
                                                    onsubmit="return confirm('Amelia, yakin ingin menghapus dosen ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="fas fa-info-circle me-1"></i> Belum ada data dosen.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahDosen" tabindex="-1" aria-labelledby="modalTambahDosenLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalTambahDosenLabel text-white">Input Data Dosen Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.dosen.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">NIP (Identity Number)</label>
                            <input type="text" name="identity_number" class="form-control"
                                placeholder="Contoh: 198810..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Masukkan nama beserta gelar" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="email@contoh.com"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password Default</label>
                            <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter"
                                required>
                            <small class="text-muted italic">*Password ini akan digunakan dosen untuk login pertama
                                kali.</small>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data Dosen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
