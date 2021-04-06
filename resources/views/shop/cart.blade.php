@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3><i class="fa fa-shopping-cart"></i> Cart</h3>
                        @if (!empty($pesanan))
                            <p align="right">Tanggal Pesan : {{ $pesanan->tanggal }}</p>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($pesanan_details as $pesanan_detail)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                <img src="image/{{ $pesanan_detail->barang->gambar }}" width="100"
                                                    alt="...">
                                            </td>
                                            <td>{{ $pesanan_detail->barang->nama_barang }}</td>
                                            <td>{{ $pesanan_detail->jumlah }}</td>
                                            <td align="right">Rp. {{ number_format($pesanan_detail->barang->harga) }}
                                            </td>
                                            <td align="right">Rp. {{ number_format($pesanan_detail->jumlah_harga) }}
                                            </td>
                                            <td>
                                                <form action="/cart/{{ $pesanan_detail->id }}" method="post">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Anda yakin akan menghapus data ?');"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" align="right"><strong>Total Harga :</strong></td>
                                        <td align="right"><strong>Rp.
                                                {{ number_format($pesanan->jumlah_harga) }}</strong></td>
                                        <td>
                                            <a href="/confirmation" class="btn btn-success"
                                                onclick="return confirm('Anda yakin akan Check Out ?');">
                                                <i class="fa fa-shopping-cart"></i> Check Out
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
