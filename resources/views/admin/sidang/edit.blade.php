@extends('layouts.app')

@section('title', 'Atur Jadwal Sidang')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="fw-bold mb-0 text-primary">Tentukan Jadwal Sidang</h5>
                    <p class="text-muted small">Mahasiswa: <strong>{{ $sidang->magang->mahasiswa->name }}</strong></p>
                </div>
                
                <form action="{{ route('admin.sidang.update', $sidang->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="card-body p-4">
                        <div class="mb-4 bg-light p-3 rounded-3">
                            <label class="small fw-bold text-muted d-block mb-1">JUDUL LAPORAN</label>
                            <span class="fw-semibold text-dark">{{ $sidang->judul_laporan }}</span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Waktu Sidang</label>
                            <input type="datetime-local" name="jadwal_sidang" class="form-control rounded-3" 
                                   value="{{ $sidang->jadwal_sidang ? date('Y-m-d\TH:i', strtotime($sidang->jadwal_sidang)) : '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Lokasi / Ruangan</label>
                            <input type="text" name="lokasi_sidang" class="form-control rounded-3" 
                                   placeholder="Contoh: Ruang Rapat Lantai 2" value="{{ $sidang->lokasi_sidang }}" required>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bold small">Keputusan Status</label>
                            <select name="status" class="form-select rounded-3">
                                <option value="pending" {{ $sidang->status == 'pending' ? 'selected' : '' }}>Pending (Tinjau Ulang)</option>
                                <option value="disetujui" {{ $sidang->status == 'disetujui' ? 'selected' : '' }}>Setujui & Jadwalkan</option>
                                <option value="ditolak" {{ $sidang->status == 'ditolak' ? 'selected' : '' }}>Tolak Berkas (Revisi)</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-footer bg-light border-0 p-4 d-flex gap-2">
                        <a href="{{ route('admin.sidang.index') }}" class="btn btn-light rounded-pill w-50">Batal</a>
                        <button type="submit" class="btn btn-primary rounded-pill w-50 fw-bold shadow-sm">Simpan Keputusan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection