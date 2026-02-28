@extends('layouts.app')

@section('title', 'Detail Logbook')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-primary">Detail Kegiatan Harian</h5>
                    <span class="badge bg-success px-3 py-2">Selesai</span>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="text-muted small text-uppercase fw-bold">Tanggal</label>
                        <h5 class="fw-bold text-dark">{{ \Carbon\Carbon::parse($logbook->tanggal)->format('d F Y') }}</h5>
                    </div>

                    <div class="mb-4">
                        <label class="text-muted small text-uppercase fw-bold">Deskripsi Kegiatan</label>
                        <div class="p-3 bg-light rounded border text-dark" style="white-space: pre-wrap; line-height: 1.6;">
                            {{ $logbook->kegiatan }}
                        </div>
                    </div>

                    <div class="row text-center text-muted small">
                        <div class="col-6 border-end">
                            <p class="mb-0">Dibuat pada:</p>
                            <strong>{{ $logbook->created_at->format('d/m/Y H:i') }}</strong>
                        </div>
                        <div class="col-6">
                            <p class="mb-0">Terakhir Update:</p>
                            <strong>{{ $logbook->updated_at->format('d/m/Y H:i') }}</strong>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white py-3 d-flex justify-content-between">
                    <a href="{{ route('mahasiswa.logbook.index') }}" class="btn btn-secondary px-4">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <a href="{{ route('mahasiswa.logbook.edit', $logbook->id) }}" class="btn btn-warning text-white px-4">
                        <i class="fas fa-edit me-1"></i> Edit Catatan
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
