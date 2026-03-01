@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="fw-bold mb-4">Pendaftaran Sidang Magang</h3>

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-4">{{ session('success') }}</div>
            @endif

            @if(!$sidang)
                {{-- TAMPILKAN FORM JIKA BELUM DAFTAR --}}
                <div class="card border-0 shadow-sm rounded-4">
                    <form action="{{ route('mahasiswa.sidang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="magang_id" value="{{ $magang->id }}">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label class="fw-bold">Judul Laporan Akhir</label>
                                <input type="text" name="judul_laporan" class="form-control rounded-3" required>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Upload Laporan (PDF)</label>
                                <input type="file" name="file_laporan" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Upload Nilai Industri (PDF/Image)</label>
                                <input type="file" name="file_nilai_industri" class="form-control" required>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 p-4 text-end">
                            <button type="submit" class="btn btn-primary px-4 rounded-pill">Ajukan Sidang</button>
                        </div>
                    </form>
                </div>
            @else
                {{-- TAMPILKAN STATUS BERDASARKAN DATABASE --}}
                @if($sidang->status == 'disetujui')
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center animate-up">
                        <div class="mb-3">
                            <i class="fas fa-check-circle fa-3x text-success"></i>
                        </div>
                        <h5>Status Pengajuan: 
                            <span class="badge bg-success bg-opacity-10 text-success px-3 rounded-pill">Disetujui</span>
                        </h5>
                        <hr class="my-4">
                        <div class="text-start bg-light p-3 rounded-4">
                            <p class="mb-2 text-muted small fw-bold text-uppercase">Informasi Sidang</p>
                            <p class="mb-2"><strong><i class="fas fa-calendar-alt me-2 text-primary"></i> Jadwal:</strong> {{ \Carbon\Carbon::parse($sidang->jadwal_sidang)->format('d M Y, H:i') }} WIB</p>
                            <p class="mb-0"><strong><i class="fas fa-map-marker-alt me-2 text-danger"></i> Lokasi:</strong> {{ $sidang->lokasi_sidang }}</p>
                        </div>
                    </div>
                @elseif($sidang->status == 'pending')
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-clock fa-3x text-warning"></i>
                        </div>
                        <h5>Status Pengajuan: 
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 rounded-pill">Pending</span>
                        </h5>
                        <p class="text-muted mt-2">Laporan anda sedang diverifikasi oleh Admin. Harap pantau halaman ini secara berkala.</p>
                    </div>
                @else
                    {{-- Tampilan jika ditolak --}}
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                        <i class="fas fa-times-circle fa-3x text-danger mb-3"></i>
                        <h5>Status Pengajuan: <span class="badge bg-danger bg-opacity-10 text-danger px-3 rounded-pill">Ditolak</span></h5>
                        <p class="text-muted mt-2">Mohon maaf, pengajuan sidang Anda ditolak. Silakan cek kembali kelengkapan berkas Anda.</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection