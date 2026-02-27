@extends('layouts.app')

@section('content')
<div class="row">

<div class="col-md-12 mb-3">
<form action="{{ route('buku.search') }}" method="GET">
    <div class="input-group input-group-lg">
        <input type="search" name="q" class="form-control form-control-lg" placeholder="Cari buku..." value="{{ request('q') }}">
        <div class="input-group-append">
            <button type="submit" class="btn btn-lg btn-default">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</form>
</div>
@foreach($buku as $item)
<div class="col-md-3">
    <div class="card card-outline card-olive">
        <div class="card-body card-olive bg-secondary">
            
            <h5 class="card-title">
                <i class="fas fa-book"></i>
                {{ $item->nama_buku }}
            </h5>

            <p class="card-text mt-2">
                <strong>Pengarang:</strong> {{ $item->pengarang }} <br>
                <strong>Penerbit:</strong> {{ $item->penerbit }} <br>
                <strong>Stok:</strong> 
                <span class="badge badge-info">
                    {{ $item->stok }}
                </span>
            </p>

            <div class="mt-3">
                @if($item->stok > 0)
                    <a href="{{ route('peminjaman.input', $item->id) }}" 
                       class="btn btn-sm btn-success btn-block">
                        <i class="fas fa-hand-holding"></i> Pinjam
                    </a>
                @else
                    <button class="btn btn-sm btn-secondary btn-block" disabled>
                        Stok Habis
                    </button>
                @endif
            </div>

        </div>
    </div>
</div>
@endforeach

</div>

@endsection