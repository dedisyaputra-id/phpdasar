@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($barangs as $barang)
                <div class="col-md-4 kartu">
                    <div class="card shadow-sm p-3 mb-5 bg-body rounded">
                        <img src="image/{{ $barang->gambar }}" class="card-img-top" alt="..." height="240px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                            <p class="card-text">
                                <strong>Harga :
                                </strong> Rp. {{ number_format($barang->harga) }} <br>
                                <Strong>Stok :
                                </strong>{{ $barang->stok }} <br>
                                <hr>
                            </p>
                            <a href="show/{{ $barang->slug }}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>
                                Pesan</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-betwen mt-4">
            {{ $barangs->links() }}
        </div>
    </div>
@endsection
