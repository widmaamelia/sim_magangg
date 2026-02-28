@extends('layouts.app')

@section('title', 'Pengajuan Tempat Magang')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-primary">Status Pengajuan Anda</h5>

                    @if ($pengajuan->count() == 0)
                        <a href="{{ route('mahasiswa.pengajuan.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-paper-plane me-1"></i> Buat Pengajuan Baru
                        </a>
                    @endif
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Perusahaan</th>
                                    <th>Alamat</th>
                                    <th>Periode Magang</th>
                                    <th>Status</th>
                                    <th>Dosen Pembimbing</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengajuan as $p)
                                    <tr>
                                        <td class="fw-bold">{{ $p->nama_perusahaan }}</td>
                                        <td>{{ $p->alamat_perusahaan }}</td>
                                        <td>
                                            <small class="text-muted">
                                                {{ date('d M Y', strtotime($p->tanggal_mulai)) }}
                                                s/d
                                                {{ date('d M Y', strtotime($p->tanggal_selesai)) }}
                                            </small>
                                        </td>
                                        <td>
                                            @if ($p->status == 'pending')
                                                <span class="badge bg-warning text-dark">
                                                    <i class="fas fa-clock me-1"></i> Menunggu
                                                </span>
                                            @elseif($p->status == 'disetujui')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle me-1"></i> Disetujui
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-times-circle me-1"></i> Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $p->dosen->name ?? 'Belum Ditentukan' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                                            Kamu belum memiliki pengajuan magang.
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
@endsection
