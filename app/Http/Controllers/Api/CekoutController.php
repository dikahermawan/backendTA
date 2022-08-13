<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\cekout;
use App\Models\user_pembeli;
use App\Models\Produk;

class CekoutController extends Controller
{

    public function cekout(Request $request){
        $produk = Produk::find($request->produk_id);
        $pembeli = user_pembeli::find($request->pembeli_id);

        // return response()->json($produk);
        $data=[
            'success' => 1,
            "message"=>"Berhasil ditampilkan",
            "status"=>200,
            "produk"=>$produk,
            "pembeli"=>$pembeli,

        ];
        // return response()->json($produk);
        return response()->json([
            "produk"=>$produk,
            "pembeli"=>$pembeli,
        ], 200);
    }


    public function tambah_cekout(Request $request)
    {
        // proses validasi
        $validator = Validator::make($request->all(),[
            'jumlah'             => 'required',
            'catatan'          => 'required',
            // 'status_pesanan'   => 'required',
        ]);

        // pengondisian error
        if ($validator->fails()) {
            return response()->json([
                'success'   => 0,
                'pesan'     =>$validator->errors()], 401);
        }

        //proses input data cekout baru
        $produk = Produk::find($request->produk_id);
        $pembeli = user_pembeli::find($request->pembeli_id);

        $ongkir = 10000;
        $no_rekening = 78956743;
        $harga = $produk->harga;
        $subtotal = $harga * $request->jumlah;

        $total_bayar =  $subtotal + $ongkir;

        $alamat = $pembeli->alamat;
        $nama_pembeli = $pembeli->nama;

        $gambar = $produk->gambar;


        $cekout = cekout::create([
            'pembeli_id'     => $request->pembeli_id,
            'produk_id'      => $request->produk_id,
            'ongkir'         => $ongkir,
            'harga'          => $harga,
            'alamat'         => $alamat,
            'nama_pembeli'   => $nama_pembeli,
            'no_rekening'    => $no_rekening,
            'jumlah'         => $request->jumlah,
            'subtotal'       => $subtotal,
            'total_bayar'    => $total_bayar,
            'catatan'        => $request->catatan,
            'gambar'         => $gambar,
            // 'status_pesanan' => $request->input('status_pesanan'),
        ]);

        // pengondisian sukses
        if ($cekout) {
            return response()->json([
                'success' => 1,
                'message' => 'Cekout Produk Berhasil Ditambahkan',
                'cekout' => $cekout,
                'produk' => $produk,
                'pembeli' => $pembeli,
                'cekout_id'        => (string)$cekout->id,
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'message' => 'Cekout Produk Gagal Ditambahkan',
            ], 401);
        }
    }
}
