@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Peminjaman Buku</h3>
        </div>

        <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">

                {{-- Nama Peminjam (Readonly) --}}
                <div class="form-group">
                    <label>Nama Peminjam</label>
                    <input type="text"
                        class="form-control"
                        value="{{ $peminjaman->user->name }}"
                        readonly>
                </div>

                {{-- User ID (Hidden) --}}
                <input type="hidden" name="user_id" value="{{ $peminjaman->user_id }}">

                {{-- Nama Buku (Readonly) --}}
                <div class="form-group">
                    <label>Nama Buku</label>
                    <input type="text"
                        class="form-control"
                        value="{{ $peminjaman->buku->nama_buku }}"
                        readonly>
                </div>

                {{-- Buku ID (Hidden) --}}
                <input type="hidden" name="buku_id" value="{{ $peminjaman->buku_id }}">

                {{-- Stok Buku (Readonly) --}}
                <div class="form-group">
                    <label>Stok Tersedia</label>
                    <input type="text"
                        class="form-control"
                        value="{{ $peminjaman->buku->stok }}"
                        readonly>
                </div>

                {{-- Tanggal Pinjam --}}
                <div class="form-group">
                    <label>Tanggal Pinjam</label>
                    <input type="date"
                        name="tanggal_pinjam"
                        class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                        value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}"
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
                        value="{{ old('tanggal_kembali', $peminjaman->tanggal_kembali) }}"
                        required>
                    @error('tanggal_kembali')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="dipinjam" {{ $peminjaman->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="kembali" {{ $peminjaman->status == 'kembali' ? 'selected' : '' }}>Kembali</option>
                        <option value="terlambat" {{ $peminjaman->status == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> Update Peminjaman
                </button>
                <a href="{{ route('peminjaman.tampil') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>
@endsection