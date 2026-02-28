@extends('layouts.app')

@section('title', 'Persetujuan Magang')

@section('content')

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="fw-bold mb-0 text-primary">Daftar Pengajuan Magang</h5>
        </div>
        {{-- Navigasi Filter Kelas --}}
<div class="mb-4">
    <div class="btn-group shadow-sm" role="group">
        <a href="{{ route('admin.pengajuan.index') }}" 
           class="btn {{ !request('kelas') ? 'btn-primary' : 'btn-outline-primary' }}">Semua Kelas</a>
        
        <a href="{{ route('admin.pengajuan.index', ['kelas' => 'MI3A']) }}" 
           class="btn {{ request('kelas') == 'MI3A' ? 'btn-primary' : 'btn-outline-primary' }}">Kelas MI3A</a>
        
        <a href="{{ route('admin.pengajuan.index', ['kelas' => 'MI3B']) }}" 
           class="btn {{ request('kelas') == 'MI3B' ? 'btn-primary' : 'btn-outline-primary' }}">Kelas MI3B</a>
           
        <a href="{{ route('admin.pengajuan.index', ['kelas' => 'MI3C']) }}" 
           class="btn {{ request('kelas') == 'MI3C' ? 'btn-primary' : 'btn-outline-primary' }}">Kelas MI3C</a>
    </div>
</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted">
                        <tr>
                            <th class="ps-4 py-3">Mahasiswa</th>
                            <th>Perusahaan</th>
                            <th style="min-width: 250px;">Dosen Pembimbing</th>
                            <th>Status</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($pengajuans as $p)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $p->mahasiswa->name }}</div>
                                    <small class="text-muted">{{ $p->mahasiswa->identity_number }}</small>
                                </td>

                                <td>{{ $p->nama_perusahaan }}</td>

                                <td>
                                    @if ($p->dosen)
                                        {{-- Jika Dosen Sudah Ada --}}
                                        <span class="badge bg-info text-white fw-normal px-3 py-2">
                                            <i class="fas fa-user-tie me-1"></i> {{ $p->dosen->name }}
                                        </span>
                                    @elseif($p->status === 'disetujui')
                                        {{-- Jika Sudah Disetujui tapi Dosen Belum Ada (Tanpa Modal) --}}
                                        <form action="{{ route('admin.pengajuan.tentukan-pembimbing', $p->id) }}"
                                            method="POST" id="formDosen{{ $p->id }}">
                                            @csrf
                                            @method('PUT')
                                            <select name="dosen_id"
                                                class="form-select form-select-sm border-primary shadow-sm"
                                                onchange="document.getElementById('btnSimpan{{ $p->id }}').classList.remove('d-none')">
                                                <option value="" selected disabled>-- Pilih Pembimbing --</option>
                                                @foreach ($dosens as $d)
                                                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    @else
                                        <span class="text-muted small italic">Menunggu Persetujuan</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($p->status === 'pending')
                                        <span class="badge bg-warning text-dark px-3">Pending</span>
                                    @elseif($p->status === 'disetujui')
                                        <span class="badge bg-success px-3">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger px-3">Ditolak</span>
                                    @endif
                                </td>

                                <td class="text-center pe-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- Tombol Simpan (Muncul saat Dropdown Dosen dipilih) --}}
                                        <button type="submit" form="formDosen{{ $p->id }}"
                                            id="btnSimpan{{ $p->id }}"
                                            class="btn btn-sm btn-primary d-none shadow-sm">
                                            <i class="fas fa-save me-1"></i> Simpan
                                        </button>

                                        {{-- Aksi Terima/Tolak untuk status Pending --}}
                                        @if ($p->status === 'pending')
                                            <form action="{{ route('admin.pengajuan.terima', $p->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <button class="btn btn-sm btn-success text-white" title="Setujui"
                                                    onclick="return confirm('Terima pengajuan ini?')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.pengajuan.tolak', $p->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <button class="btn btn-sm btn-outline-danger" title="Tolak"
                                                    onclick="return confirm('Tolak pengajuan ini?')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif

                                        {{-- Detail --}}
                                        <a href="{{ route('admin.pengajuan.show', $p->id) }}"
                                            class="btn btn-sm btn-light border text-muted">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    Belum ada pengajuan magang.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .table thead th {
            font-size: 0.8rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .form-select-sm {
            border-radius: 6px;
        }

        .btn-sm {
            border-radius: 6px;
        }
    </style>

@endsection
