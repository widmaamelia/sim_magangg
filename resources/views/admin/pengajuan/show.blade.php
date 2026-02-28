@extends('layouts.app')

@section('title', 'Detail Pengajuan Magang')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="fw-bold mb-0">Detail Pengajuan Magang</h5>
        </div>

        <div class="card-body">
            <div class="row g-3">

                <div class="col-md-6">
                    <label class="fw-bold">Nama Mahasiswa</label>
                    <div class="form-control bg-light">{{ $pengajuan->mahasiswa->name }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">NIM</label>
                    <div class="form-control bg-light">{{ $pengajuan->mahasiswa->identity_number }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Perusahaan</label>
                    <div class="form-control bg-light">{{ $pengajuan->nama_perusahaan }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Status</label>
                    <div class="form-control bg-light">{{ ucfirst($pengajuan->status) }}</div>
                </div>

                <div class="col-md-12">
                    <label class="fw-bold">Dosen Pembimbing</label>
                    <div class="form-control bg-light">
                        {{ $pengajuan->dosen?->name ?? 'Belum ditentukan' }}
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </div>
    </div>

@endsection
