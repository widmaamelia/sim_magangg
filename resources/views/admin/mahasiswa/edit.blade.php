@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Edit Mahasiswa</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $mahasiswa->name) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="text" name="identity_number" class="form-control"
                        value="{{ old('identity_number', $mahasiswa->identity_number) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $mahasiswa->email) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password (opsional)</label>
                    <input type="password" name="password" class="form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </form>
        </div>
    </div>
@endsection
