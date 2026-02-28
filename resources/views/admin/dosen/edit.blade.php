@extends('layouts.app')
@section('title', 'Edit Dosen')
@section('content')
    <div class="container">
        {{-- <h4 class="mb-3">Edit Data Dosen</h4> --}}

        <form action="{{ route('admin.dosen.update', $dosen->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ $dosen->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">NIP</label>
                <input type="text" name="identity_number" class="form-control" value="{{ $dosen->identity_number }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $dosen->email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password (Opsional)</label>
                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
            </div>

            <button class="btn btn-warning">
                Update
            </button>

            <a href="{{ route('admin.dosen.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
@endsection
