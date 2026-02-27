@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Peminjaman Buku</h3>
        </div>

        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- Nama Peminjam (User yang login) --}}
                <div class="form-group">
                    <label>Nama Peminjam</label>
                    <input type="text"
                        class="form-control"
                        value="{{ auth()->user()->name }}"
                        readonly>
                </div>

                {{-- User ID (Hidden) --}}
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                {{-- Nama Buku (Otomatis terisi dari dashboard) --}}
                <div class="form-group">
                    <label>Nama Buku</label>
                    <input type="text"
                        class="form-control"
                        value="{{ $buku->nama_buku }}"
                        readonly>
                </div>

                {{-- Buku ID (Hidden) --}}
                <input type="hidden" name="buku_id" value="{{ $buku->id }}">

                {{-- Stok Buku --}}
                <div class="form-group">
                    <label>Stok Tersedia</label>
                    <input type="text"
                        class="form-control"
                        value="{{ $buku->stok }}"
                        readonly>
                </div>

                {{-- Tanggal Pinjam --}}
                <div class="form-group">
                    <label>Tanggal Pinjam</label>
                    <input type="date"
                        name="tanggal_pinjam"
                        class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                        value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                        required>
                    @error('tanggal_pinjam')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tanggal Kembali --}}
                <div class="form-group">
                    <label>Tanggal Kembali</label>
                    <input type="date"
                        name="tanggal_kembali"
                        class="form-control @error('tanggal_kembali') is-invalid @enderror"
                        value="{{ old('tanggal_kembali') }}"
                        required>
                    @error('tanggal_kembali')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jumlah Buku --}}
                <div class="form-group">
                    <label>Jumlah Buku</label>
                    <input type="number"
                        name="jumlah"
                        class="form-control @error('jumlah') is-invalid @enderror"
                        value="{{ old('jumlah', 1) }}"
                        min="1"
                        max="{{ $buku->stok }}"
                        required>
                    @error('jumlah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> Konfirmasi Peminjaman
                </button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>
@endsection