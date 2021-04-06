<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Pesanandetail;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class ShopController extends Controller
{
    public function index()
    {
        $barangs = Barang::latest()->paginate(6);
        return view('shop.index', compact('barangs'));
    }
    public function show(Barang $barang)
    {
        return view('shop.show', compact('barang'));
    }

    public function store(Request $request, $slug)
    {
        $barang = Barang::where('slug', $slug)->first();
        $tanggal = Carbon::now();

        // validasi apkah melebihi stok
        if ($request->jumlah_pesan > $barang->stok) {
            Toastr::warning('Jumlah pesanan melebihi stok', '');
            return redirect('show/' . $slug);
        }


        // cek validasi
        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        // simpan ke database
        if (empty($cek_pesanan)) {
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->kode = mt_rand(100, 999);
            $pesanan->save();
        }
        //simpan ke database pesanan detail
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        //cek pesanan detail
        $cek_pesanan_detail = Pesanandetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
        if (empty($cek_pesanan_detail)) {
            $pesanan_detail = new Pesanandetail;
            $pesanan_detail->barang_id = $barang->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $barang->harga * $request->jumlah_pesan;
            $pesanan_detail->save();
        } else {
            $pesanan_detail = Pesanandetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();

            $pesanan_detail->jumlah = $pesanan_detail->jumlah + $request->jumlah_pesan;

            //harga sekarang
            $harga_pesanan_detail_baru = $barang->harga * $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga + $harga_pesanan_detail_baru;
            $pesanan_detail->update();
        }
        //jumlah total
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga + $barang->harga * $request->jumlah_pesan;
        $pesanan->update();

        Toastr::success('Pesanan Berhasil Masuk Keranjang', '');
        return redirect('/shop')->with('succes', 'Pesanan sukses masuk keranjang');
    }
    public function cart()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if (!empty($pesanan)) {
            $pesanan_details = Pesanandetail::where('pesanan_id', $pesanan->id)->get();
        } else {
            return view('shop.cart');
        }

        return view('shop.cart', compact('pesanan', 'pesanan_details'));
    }
    public function delete($id)
    {
        $pesanan_detail = Pesanandetail::where('id', $id)->first();

        $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga - $pesanan_detail->jumlah_harga;
        $pesanan->update();
        $pesanan_detail->delete();
        Toastr::error('Pesanan Berhasil Dihapus', '');
        return redirect('/cart');
    }
    public function confirmation()
    {
        $user = User::where('id', Auth::user()->id)->first();

        if (empty($user->alamat)) {
            Toastr::info('Identitasi Harap dilengkapi', '');
            return redirect('profile');
        }

        if (empty($user->nohp)) {
            Toastr::info('Identitasi Harap dilengkapi', '');
            return redirect('profile');
        }

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan_id = $pesanan->id;
        $pesanan->status = 1;
        $pesanan->update();

        $pesanan_details = Pesanandetail::where('pesanan_id', $pesanan_id)->get();
        foreach ($pesanan_details as $pesanan_detail) {
            $barang = Barang::where('id', $pesanan_detail->barang_id)->first();
            $barang->stok = $barang->stok - $pesanan_detail->jumlah;
            $barang->update();
        }
        Toastr::success('Pesanan Sukses Check Out Silahkan Lanjutkan Proses Pembayaran', 'Success');
        return redirect('history/' . $pesanan_id);
    }
}
