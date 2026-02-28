@extends('layouts.app')

@section('title', 'Edit Logbook')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-warning">Edit Kegiatan Harian</h5>
                </div>
                <form action="{{ route('mahasiswa.logbook.update', $logbook->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- PENTING: Untuk update wajib pakai method PUT --}}

                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Kegiatan</label>
                            <input type="date" name="tanggal" class="form-control border-warning"
                                value="{{ $logbook->tanggal }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi Kegiatan</label>
                            <textarea name="kegiatan" class="form-control border-warning" rows="6" required>{{ $logbook->kegiatan }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-between py-3">
                        <a href="{{ route('mahasiswa.logbook.index') }}" class="btn btn-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-warning text-white px-4 shadow-sm fw-bold">Update
                            Catatan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
