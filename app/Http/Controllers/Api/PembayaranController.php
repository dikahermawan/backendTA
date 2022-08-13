<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cekout;
use App\Models\Pembayaran;
use App\Models\user_pembeli;
use Validator;


class PembayaranController extends Controller
{
    //
    public function databayar(Request $request){
        // $cekout = cekout::find($request->cekout_id);

        $bayar = new cekout();
        $bayar = $bayar->where('pembeli_id', $request->pembeli_id)->get();
        $data=[
            'success' => 1,
            "message"=>"Berhasil ditampilkan",
            "status"=>200,
            // "cekout"=>$cekout,
            "bayar"=>$bayar,
        ];

        return response()->json($bayar);
        // $cekout = cekout::find($request->cekout_id);
        // $data=[
        //     'success' => 1,
        //     "message"=>"Berhasil ditampilkan",
        //     "status"=>200,
        //     "cekout"=>$cekout,
        // ];
        // return response()->json($data);
        // return response()->json([
        //    $cekout,
        // ], 200);

        // $cekout = new cekout();
        // $cekout = $cekout->where('cekout_id', $request->cekout_id)->get();
        // $data=[
            // 'success' => 1,
            // "message"=>"Berhasil ditampilkan",
            // "status"=>200,
            // "cekout"=>$cekout,
        // ];
        // return response()->json($cekout);
    }

    public function tambah_bayar(Request $request)
    {
        // proses validasi
        $validator = Validator::make($request->all(),[
            'gambar'             => 'required',
        ]);

        // pengondisian error
        if ($validator->fails()) {
            return response()->json([
                'success'   => 0,
                'pesan'     =>$validator->errors()], 401);
        }

        $gambar = $request->file('gambar')->getClientOriginalName();
        $path = $request->file('gambar')->move('img/buktibayar', $gambar);

        //proses input data cekout baru
        $cekout = cekout::find($request->cekout_id);


        $nama_pelanggan = $cekout->nama_pembeli;
        $no_rekening = $cekout->no_rekening;
        $alamat = $cekout->alamat;
        $harga = $cekout->harga;
        $jumlah = $cekout->jumlah;
        $subtotal = $cekout->subtotal;
        $total_bayar = $cekout->total_bayar;
        $ongkir = $cekout->ongkir;


        $bayar = Pembayaran::create([
            'cekout_id'      => $request->cekout_id,
            'pembeli_id'      => $request->pembeli_id,
            'gambar'         => $gambar,
            'nama_pembeli'   => $nama_pelanggan,
            'alamat'         => $alamat,
            'harga'          => $harga,
            'jumlah'         => $jumlah,
            'subtotal'       => $subtotal,
            'total_bayar'    => $total_bayar,
            'no_rekening'    => $no_rekening,
            'ongkir'         => $ongkir,


            // 'status_pesanan' => $request->input('status_pesanan'),
        ]);
        // pengondisian sukses
        if ($bayar) {
            return response()->json([
                'success'   => 1,
                'message'   => 'Bayar Produk Berhasil Ditambahkan',
                'bayar'     => $bayar,
                'cekout'    => $cekout,
                'bayar_id'  => (string)$bayar->id,
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'message' => 'Cekout Produk Gagal Ditambahkan',
            ], 401);
        }
    }
}
