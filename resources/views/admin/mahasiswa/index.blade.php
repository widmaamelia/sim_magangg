@extends('layouts.app')

@section('title', 'Manajemen Mahasiswa')

@section('content')
<div class="card shadow-sm border-0">

    {{-- Header --}}
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        {{-- <h5 class="fw-bold text-primary mb-0">Manajemen Mahasiswa</h5> --}}
        <a href="{{ route('admin.mahasiswa.create') }}" 
           class="btn btn-success btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Mahasiswa
        </a>
    </div>

    <div class="card-body">

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @php
            $kelasList = ['MI3A', 'MI3B', 'MI3C'];
        @endphp

        {{-- Tabs --}}
        <ul class="nav nav-pills mb-4">
            @foreach ($kelasList as $index => $kls)
                <li class="nav-item">
                    <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                            data-bs-toggle="pill"
                            data-bs-target="#kelas-{{ $kls }}">
                        Kelas {{ $kls }}
                    </button>
                </li>
            @endforeach
        </ul>

        {{-- Tab Content --}}
        <div class="tab-content">
            @foreach ($kelasList as $index => $kls)
                <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                     id="kelas-{{ $kls }}">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">NIM</th>
                                    <th width="20%">Nama</th>
                                    <th width="10%">Kelas</th>
                                    <th width="20%">Email</th>
                                    <th width="10%">Status</th>
                                    {{-- <th width="15%" class="text-center">Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mahasiswas->where('kelas', $kls) as $mhs)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td class="fw-semibold">
                                            {{ $mhs->identity_number }}
                                        </td>

                                        <td>{{ $mhs->name }}</td>

                                        <td>
                                            <span class="badge bg-primary-subtle text-primary">
                                                {{ $mhs->kelas }}
                                            </span>
                                        </td>

                                        <td>{{ $mhs->email }}</td>

                                        <td>
                                            @if ($mhs->magangs->count())
                                                <span class="badge bg-success">
                                                    Sudah Mengajukan
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    Belum Mengajukan
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Aksi --}}
                                        {{-- <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">

                                                <a href="{{ route('admin.mahasiswa.show', $mhs->id) }}"
                                                   class="btn btn-outline-info"
                                                   title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="{{ route('admin.mahasiswa.edit', $mhs->id) }}"
                                                   class="btn btn-outline-warning"
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-outline-danger"
                                                            title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td> --}}
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            Belum ada mahasiswa di kelas 
                                            <strong>{{ $kls }}</strong>.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection