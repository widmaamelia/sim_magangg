@extends('layouts.app')

@section('title', 'Input Nilai Mahasiswa')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-primary">Input Nilai Magang</h5>
                </div>
                <form action="{{ route('dosen.penilaian.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="magang_id" value="{{ $magang->id }}">

                    <div class="card-body p-4">
                        {{-- Informasi Mahasiswa --}}
                        <div class="alert alert-light border mb-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Nama Mahasiswa</small>
                                    <strong>{{ $magang->mahasiswa->name }}</strong>
                                </div>
                                <div class="col-sm-6 text-sm-end">
                                    <small class="text-muted d-block">NIM / Kelas</small>
                                    <strong>{{ $magang->mahasiswa->identity_number }} /
                                        {{ $magang->mahasiswa->kelas }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nilai Angka (0 - 100)</label>
                            <input type="number" name="nilai" class="form-control" min="0" max="100" required
                                placeholder="Contoh: 85">
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bold">Keterangan / Catatan</label>
                            <textarea name="keterangan" class="form-control" rows="4" placeholder="Berikan masukan untuk mahasiswa..."></textarea>
                        </div>
                    </div>

                    <div class="card-footer bg-light d-flex justify-content-between py-3">
                        <a href="{{ route('dosen.monitoring.index') }}" class="btn btn-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">Simpan Nilai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
