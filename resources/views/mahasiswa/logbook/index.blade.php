@extends('layouts.app')

@section('title', 'Logbook Harian')

@section('content')
<div class="card border-0 shadow-sm">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        {{-- <h5 class="mb-0 fw-semibold">Logbook Harian</h5> --}}

        <a href="{{ route('mahasiswa.logbook.create') }}" 
           class="btn btn-indigo btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Logbook
        </a>
    </div>

    <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Tanggal</th>
                        <th>Kegiatan</th>
                        <th width="15%">Status</th>
                        <th width="15%">Lampiran</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logbooks as $log)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($log->tanggal)->format('d M Y') }}
                            </td>

                            <td>
                                {{ $log->kegiatan }}
                                @if($log->komentar_dosen)
                                    <div class="small text-muted mt-1">
                                        <strong>Catatan:</strong> {{ $log->komentar_dosen }}
                                    </div>
                                @endif
                            </td>

                            <td>
                                @if($log->status == 'acc')
                                    <span class="badge bg-success">
                                        Disetujui
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        Menunggu
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if($log->file_lampiran)
                                    <a href="{{ asset('storage/' . $log->file_lampiran) }}" 
                                       target="_blank"
                                       class="btn btn-sm btn-outline-info">
                                        Lihat
                                    </a>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>

                            <td class="text-center">

    {{-- Detail --}}
    <a href="{{ route('mahasiswa.logbook.show', $log->id) }}"
       class="text-secondary me-2"
       title="Detail">
        <i class="fas fa-eye"></i>
    </a>

    @if($log->status != 'acc')

        {{-- Edit --}}
        <a href="{{ route('mahasiswa.logbook.edit', $log->id) }}"
           class="text-warning me-2"
           title="Edit">
            <i class="fas fa-edit"></i>
        </a>

        {{-- Hapus --}}
        <form action="{{ route('mahasiswa.logbook.destroy', $log->id) }}" 
              method="POST" 
              class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="btn btn-link p-0 text-danger"
                    title="Hapus"
                    onclick="return confirm('Yakin hapus logbook ini?')">
                <i class="fas fa-trash"></i>
            </button>
        </form>

    @endif

</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Belum ada logbook.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<style>
    .btn-indigo {
        background-color: #4F46E5;
        color: #fff;
        border: none;
    }

    .btn-indigo:hover {
        background-color: #4338CA;
        color: #fff;
    }
</style>
@endsection