@extends('layouts.app')

@section('title', 'Dashboard Dosen')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card border-start border-info border-5 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-muted">Mahasiswa Bimbingan</h5>
                    <div class="d-flex align-items-center">
                        <h2 class="display-4 fw-bold mb-0">{{ $total_bimbingan }}</h2>
                        <span class="ms-3 text-muted">Orang Mahasiswa</span>
                    </div>
                    <a href="{{ route('dosen.dashboard') }}" class="btn btn-info btn-sm mt-3 text-white">Lihat Daftar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
