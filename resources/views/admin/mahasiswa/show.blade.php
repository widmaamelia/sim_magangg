@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Detail Mahasiswa</h5>
        </div>

        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200">Nama Lengkap</th>
                    <td>: {{ $mahasiswa->name }}</td>
                </tr>
                <tr>
                    <th>NIM</th>
                    <td>: {{ $mahasiswa->identity_number }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>: {{ $mahasiswa->email }}</td>
                </tr>
                <tr>
                    <th>Status Magang</th>
                    <td>
                        @if ($mahasiswa->magangs->count() > 0)
                            <span class="badge bg-info text-dark">Sudah Mengajukan</span>
                        @else
                            <span class="badge bg-secondary">Belum Mengajukan</span>
                        @endif
                    </td>
                </tr>
            </table>

            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </div>
@endsection
