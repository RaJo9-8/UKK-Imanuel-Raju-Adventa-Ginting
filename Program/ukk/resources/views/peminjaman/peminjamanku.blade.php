@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Buku Pinjaman Saya</h3>
    </div>

    <div class="card-body">
        @if($peminjaman->count() > 0)
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Buku</th>
                        <th>Pengarang</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->buku->nama_buku }}</td>
                        <td>{{ $item->buku->pengarang }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>
                            @if($item->status == 'dipinjam')
                                <span class="badge badge-warning">Dipinjam</span>
                            @elseif($item->status == 'kembali')
                                <span class="badge badge-success">Dikembalikan</span>
                            @elseif($item->status == 'terlambat')
                                <span class="badge badge-danger">Terlambat</span>
                            @else
                                <span class="badge badge-secondary">{{ $item->status }}</span>
                            @endif
                        </td>
                        <td>
                            @if($item->status == 'dipinjam')
                                <form action="{{ route('peminjaman.kembalikan', $item->id) }}" 
                                      method="POST" 
                                      style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" 
                                            class="btn btn-sm btn-success"
                                            onclick="return confirm('Yakin ingin mengembalikan buku ini?')">
                                        <i class="fas fa-undo"></i> Kembalikan
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                Anda belum meminjam buku apapun. 
                <a href="{{ route('dashboard') }}" class="alert-link">Lihat koleksi buku</a>
            </div>
        @endif
    </div>

    <div class="card-footer">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
