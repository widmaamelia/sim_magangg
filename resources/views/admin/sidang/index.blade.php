@extends('layouts.app')

@section('title', 'Verifikasi Sidang')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4">Mahasiswa</th>
                        <th>Judul Laporan</th>
                        <th>Berkas</th>
                        <th class="text-center">Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sidangs as $s)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold">{{ $s->magang->mahasiswa->name }}</div>
                            <small class="text-muted">{{ $s->magang->mahasiswa->identity_number }}</small>
                        </td>
                        <td class="text-wrap" style="max-width: 250px;">{{ $s->judul_laporan }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $s->file_laporan) }}" target="_blank" class="badge bg-primary bg-opacity-10 text-primary text-decoration-none">
                                <i class="fas fa-file-pdf me-1"></i> Laporan
                            </a>
                            <a href="{{ asset('storage/' . $s->file_nilai_industri) }}" target="_blank" class="badge bg-info bg-opacity-10 text-info text-decoration-none ms-1">
                                <i class="fas fa-image me-1"></i> Nilai Industri
                            </a>
                        </td>
                        <td class="text-center">
                            <span class="badge rounded-pill px-3 py-2 bg-{{ $s->status == 'disetujui' ? 'success' : ($s->status == 'pending' ? 'warning' : 'danger') }} bg-opacity-10 text-{{ $s->status == 'disetujui' ? 'success' : ($s->status == 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($s->status) }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            {{-- TOMBOL MENUJU HALAMAN PISAH --}}
                            <a href="{{ route('admin.sidang.edit', $s->id) }}" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm">
                                <i class="fas fa-calendar-alt me-1"></i> Atur Jadwal
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection