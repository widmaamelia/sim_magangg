@extends('layouts.app')

@section('title', 'Detail Dosen')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4>{{ $dosen->name }}</h4>
            <p>NIP: {{ $dosen->identity_number }}</p>
            <p>Email: {{ $dosen->email }}</p>

            <a href="{{ route('admin.dosen.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </div>
@endsection
