@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold text-primary mb-0">Tambah Mahasiswa</h5>
        </div>

        <div class="card-body">

            {{-- Error Validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
                @csrf

                <div class="row">
                    {{-- Kiri --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">NIM</label>
                            <input type="text" name="identity_number"
                                class="form-control @error('identity_number') is-invalid @enderror"
                                value="{{ old('identity_number') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kelas</label>
                            <select name="kelas" class="form-select @error('kelas') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Pilih Kelas --</option>
                                <option value="MI3A" {{ old('kelas') == 'MI3A' ? 'selected' : '' }}>Manajemen Informatika
                                    3A</option>
                                <option value="MI3B" {{ old('kelas') == 'MI3B' ? 'selected' : '' }}>Manajemen Informatika
                                    3B</option>
                                <option value="MI3C" {{ old('kelas') == 'MI3C' ? 'selected' : '' }}>Manajemen Informatika
                                    3C</option>
                            </select>
                        </div>
                    </div>

                    {{-- Kanan --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                            <small class="text-muted">Minimal 8 karakter</small>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
