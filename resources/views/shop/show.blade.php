@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $barang->nama_barang }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mt-1">
                <div class="card shadow-sm p-3 mb-5 bg-body rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="/image/{{ $barang->gambar }}" class="rounded mx-auto d-block" width="100%"
                                    alt="" width="">
                            </div>
                            <div class="col-md-6 mt-5">
                                <h2>{{ $barang->nama_barang }}</h2>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Harga</td>
                                            <td>:</td>
                                            <td>Rp. {{ number_format($barang->harga) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Stok</td>
                                            <td>:</td>
                                            <td>{{ number_format($barang->stok) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td>:</td>
                                            <td>{{ $barang->keterangan }}</td>
                                        </tr>

                                        <tr>
                                            <td>Jumlah Pesan</td>
                                            <td>:</td>
                                            <td>
                                                <form action="" method="POST">
                                                    @csrf
                                                    <input type="text" name="jumlah_pesan" class="form-control" required="">
                                                    <button type="submit" class="btn btn-primary mt-3"><i
                                                            class="fa fa-shopping-cart"></i> Masukkan Keranjang</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
