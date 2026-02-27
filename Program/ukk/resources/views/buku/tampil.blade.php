@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Table Buku</h3>
    </div>

    <a href="{{ route('buku.input') }}" class="btn btn-primary m-3">
        Tambah Buku
    </a>

    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Kode Buku</th>
                    <th>Stok</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buku as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_buku }}</td>
                    <td>{{ $item->pengarang }}</td>
                    <td>{{ $item->penerbit }}</td>
                    <td>{{ $item->kode_buku }}</td>
                    <td>
                        <span class="badge badge-{{ $item->stok > 0 ? 'success' : 'danger' }}">
                            {{ $item->stok }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('buku.edit', $item->id) }}" 
                           class="btn btn-sm btn-warning">
                           Edit
                        </a>

                        <form action="{{ route('buku.delete', $item->id) }}" 
                              method="POST" 
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin hapus buku ini?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if($buku->isEmpty())
                <tr>
                    <td colspan="7" class="text-center">
                        Data buku belum tersedia.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection