@extends('layouts.app')

@section('title', 'Buat Pengajuan Magang')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i> Form Pengajuan Magang
                    </h5>
                </div>

                <form action="{{ route('mahasiswa.pengajuan.store') }}" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="alert alert-info small">
                            <i class="fas fa-info-circle me-1"></i>
                            Pastikan data perusahaan sesuai dengan surat permohonan magang.
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Perusahaan / Instansi</label>
                            <input type="text" name="nama_perusahaan" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat Lengkap Perusahaan</label>
                            <textarea name="alamat_perusahaan" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light d-flex justify-content-between">
                        <a href="{{ route('mahasiswa.pengajuan.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
