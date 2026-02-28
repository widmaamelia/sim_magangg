@extends('layouts.app')

@section('title', 'Manajemen Data Dosen')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 rounded-3">

                {{-- HEADER --}}
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                    {{-- <h5 class="mb-0 fw-bold text-primary">Daftar Dosen</h5> --}}

                    {{-- kalau mau halaman create, ganti ke <a href="{{ route('admin.dosen.create') }}"> --}}
                    <a href="{{ route('admin.dosen.create') }}" class="btn btn-primary btn-sm px-3 shadow-sm">
                        <i class="fas fa-plus me-1"></i> Tambah Dosen
                    </a>
                </div>

                {{-- TABLE --}}
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">No</th>
                                    <th>NIP</th>
                                    <th>Nama Dosen</th>
                                    <th>Email</th>
                                    <th class="text-center pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dosens as $index => $dosen)
                                    <tr>
                                        <td class="ps-4">{{ $index + 1 }}</td>

                                        <td>
                                            <span class="badge bg-light text-dark border fw-normal">
                                                {{ $dosen->identity_number }}
                                            </span>
                                        </td>

                                        <td class="fw-bold">
                                            {{ $dosen->name }}
                                        </td>

                                        <td>
                                            {{ $dosen->email }}
                                        </td>

                                        {{-- AKSI --}}
                                        <td class="text-center pe-4">
                                            <a href="{{ route('admin.dosen.show', $dosen->id) }}"
                                                class="btn btn-info btn-sm" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('admin.dosen.edit', $dosen->id) }}"
                                                class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.dosen.destroy', $dosen->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Hapus dosen ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            Belum ada data dosen.
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
