@extends('layouts.app')

@section('title', 'Tambah Dosen')

@section('content')
    <div class="card shadow-sm">
        {{-- <div class="card-header bg-white">
            <h5 class="mb-0">Tambah dosen </h5>
        </div> --}}

        <div class="card-body">
            <form action="{{ route('admin.dosen.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nip</label>
                    <input type="text" name="identity_number" class="form-control" value="{{ old('identity_number') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label"> Nama Dosen</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">
                    Simpan
                </button>
                <a href="{{ route('admin.dosen.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </form>
        </div>
    </div>
@endsection
