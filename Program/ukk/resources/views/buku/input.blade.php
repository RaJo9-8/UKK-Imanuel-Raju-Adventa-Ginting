@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Buku</h3>
        </div>

        <form action="{{ route('buku.store') }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- Nama Buku --}}
                <div class="form-group">
                    <label>Nama Buku</label>
                    <input type="text"
                        name="nama_buku"
                        class="form-control @error('nama_buku') is-invalid @enderror"
                        value="{{ old('nama_buku') }}"
                        required>
                    @error('nama_buku')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Pengarang --}}
                <div class="form-group">
                    <label>Pengarang</label>
                    <input type="text"
                        name="pengarang"
                        class="form-control @error('pengarang') is-invalid @enderror"
                        value="{{ old('pengarang') }}"
                        required>
                    @error('pengarang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Penerbit --}}
                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text"
                        name="penerbit"
                        class="form-control @error('penerbit') is-invalid @enderror"
                        value="{{ old('penerbit') }}"
                        required>
                    @error('penerbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kode Buku --}}
                <div class="form-group">
                    <label>Kode Buku</label>
                    <input type="text"
                        name="kode_buku"
                        class="form-control @error('kode_buku') is-invalid @enderror"
                        value="{{ old('kode_buku') }}"
                        required>
                    @error('kode_buku')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Stok --}}
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number"
                        name="stok"
                        class="form-control @error('stok') is-invalid @enderror"
                        value="{{ old('stok') }}"
                        min="0"
                        required>
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('buku.tampil') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>
@endsection