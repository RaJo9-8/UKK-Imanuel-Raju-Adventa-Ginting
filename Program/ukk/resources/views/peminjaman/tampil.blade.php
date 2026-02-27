@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Table Peminjaman</h3>
    </div>

    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Nama Buku</th>
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
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->buku->nama_buku }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>{{ $item->tanggal_kembali ?? '-' }}</td>
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
                        <a href="{{ route('peminjaman.edit', $item->id) }}" 
                           class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('peminjaman.delete', $item->id) }}" 
                              method="POST" 
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin hapus data ini?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection