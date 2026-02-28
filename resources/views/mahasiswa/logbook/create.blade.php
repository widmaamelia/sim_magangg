@extends('layouts.app')

@section('title', 'Tambah Logbook Baru')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-primary">Tambah Kegiatan Harian</h5>
                </div>

                {{-- PERBAIKAN 1: Tambahkan enctype agar bisa upload file --}}
                <form action="{{ route('mahasiswa.logbook.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Kegiatan</label>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" 
                                   value="{{ date('Y-m-d') }}" required>
                            @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi Kegiatan</label>
                            <textarea name="kegiatan" class="form-control @error('kegiatan') is-invalid @enderror" rows="6"
                                placeholder="Amelia, ceritakan apa yang kamu kerjakan hari ini?" required>{{ old('kegiatan') }}</textarea>
                            @error('kegiatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- PERBAIKAN 2: Tambahkan input untuk lampiran file bukti --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">File Lampiran (Opsional)</label>
                            <input type="file" name="file_lampiran" class="form-control @error('file_lampiran') is-invalid @enderror">
                            <small class="text-muted">Amelia, kamu bisa upload foto kegiatan atau dokumen pendukung (PDF/JPG/PNG).</small>
                            @error('file_lampiran') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="card-footer bg-light d-flex justify-content-between py-3">
                        <a href="{{ route('mahasiswa.logbook.index') }}" class="btn btn-secondary px-4">Kembali</a>
                        <button type="submit" class="btn btn-success px-4 shadow-sm">Simpan Logbook</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection