@extends('layouts.app')

@section('title', 'Pengajuan Tempat Magang')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm border-0 rounded-4">

            {{-- Header --}}
            <div class="card-header bg-white d-flex justify-content-between align-items-center rounded-top-4">
                <h5 class="fw-bold text-indigo mb-0">
                    Pengajuan Tempat Magang
                </h5>

                @if ($pengajuan->count() == 0)
                    <a href="{{ route('mahasiswa.pengajuan.create') }}" 
                       class="btn btn-indigo btn-sm rounded-pill px-3">
                        <i class="fas fa-paper-plane me-1"></i> Buat Pengajuan Baru
                    </a>
                @endif
            </div>

            {{-- Body --}}
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
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
                                    <td>{{ $loop->iteration }}</td>

                                    <td class="fw-semibold text-indigo">
                                        {{ $p->nama_perusahaan }}
                                    </td>

                                    <td>{{ $p->alamat_perusahaan }}</td>

                                    <td>
                                        <small class="text-muted">
                                            {{ date('d M Y', strtotime($p->tanggal_mulai)) }}
                                            —
                                            {{ date('d M Y', strtotime($p->tanggal_selesai)) }}
                                        </small>
                                    </td>

                                    <td>
                                        @if ($p->status == 'pending')
                                            <span class="badge bg-warning-subtle text-warning rounded-pill px-3">
                                                <i class="fas fa-clock me-1"></i> Menunggu
                                            </span>
                                        @elseif($p->status == 'disetujui')
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3">
                                                <i class="fas fa-check-circle me-1"></i> Disetujui
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger rounded-pill px-3">
                                                <i class="fas fa-times-circle me-1"></i> Ditolak
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $p->dosen->name ?? 'Belum Ditentukan' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3 d-block text-secondary"></i>
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

{{-- Custom Theme --}}
<style>
    :root {
        --indigo: #4F46E5;
        --indigo-soft: #EEF2FF;
    }

    .text-indigo {
        color: var(--indigo);
    }

    .btn-indigo {
        background-color: var(--indigo);
        color: #fff;
        border: none;
    }

    .btn-indigo:hover {
        background-color: #4338CA;
        color: #fff;
    }

    .table-hover tbody tr:hover {
        background-color: #F9FAFB;
    }
</style>

@endsection