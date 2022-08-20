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

    //untuk mengambil data
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

        $nama_produk = $produk->nama;


        $cekout = cekout::create([
            'pembeli_id'     => $request->pembeli_id,
            'produk_id'      => $request->produk_id,
            'nama_produk'    => $nama_produk,
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
            'status_pesanan' => 'belum bayar',
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




    public function getbelum(Request $request){

        $cekout = new cekout();
        $cekout = $cekout->where('pembeli_id', $request->pembeli_id)
        ->where('status_pesanan', 'belum bayar')->get();

        $data=[
            'success' => 1,
            "message"=>"Berhasil ditampilkan",
            "status"=>200,
            "cekout"=>$cekout,
        ];
        return response()->json($cekout);
    }

    public function getkemas(Request $request){


        $cekout = new cekout();
        $cekout = $cekout->where('pembeli_id', $request->pembeli_id)
        ->where('status_pesanan', 'dikemas')->get();

        $data=[
            'success' => 1,
            "message"=>"Berhasil ditampilkan",
            "status"=>200,
            "cekout"=>$cekout,
        ];
        return response()->json($cekout);
        // return response()->json([
        //     'cekout' => $cekout,
        //     'produk' => $produk,
        // ], 200);
    }


    public function getkirim(Request $request){

        $cekout = new cekout();
        $cekout = $cekout->where('pembeli_id', $request->pembeli_id)
        ->where('status_pesanan', 'dikirim')->get();

        $data=[
            'success' => 1,
            "message"=>"Berhasil ditampilkan",
            "status"=>200,
            "cekout"=>$cekout,
        ];
        return response()->json($cekout);
    }


    public function getterima(Request $request){

        $cekout = new cekout();
        $cekout = $cekout->where('pembeli_id', $request->pembeli_id)
        ->where('status_pesanan', 'diterima')->get();

        $data=[
            'success' => 1,
            "message"=>"Berhasil ditampilkan",
            "status"=>200,
            "cekout"=>$cekout,
        ];
        return response()->json($cekout);
    }


    public function status_pesanan(Request $request)
    {
        $status = cekout::find($request->cekout_id);
        $status->status_pesanan = $request->status_pesanan;
        $status->update();

        return response()->json([
            'status' => $status,
            'success' => 1,
            'message' => 'Berhasil Ditambahkan'
        ], 201);
    }


    public function kemas(Request $request){

        //api data cekout untuk halaman petani
        // menampilkan data cekout sesuai id petani

        $cekout= cekout::select('cekouts.id as id','cekouts.gambar as gambar', 'cekouts.nama_produk as nama_produk','cekouts.jumlah as jumlah', 'cekouts.total_bayar as total_bayar', 'cekouts.alamat as alamat', 'cekouts.catatan as catatan', 'cekouts.nama_pembeli as nama_pembeli')
        ->join('produks','produks.id','=','cekouts.produk_id')
        ->join('user_penjuals','user_penjuals.id','=','produks.penjual_id')
        ->where('produks.penjual_id', $request->penjual_id)
        ->where('cekouts.status_pesanan', 'dikemas')
        ->get();

        $data=[
            'success' => 1,
            "message"=>"Berhasil ditampilkan",
            "status"=>200,
            "cekout"=>$cekout,
        ];
        return response()->json($cekout);
    }


    public function kirim(Request $request){

        //api data cekout untuk halaman petani
        // menampilkan data cekout sesuai id petani

        $cekout= cekout::select('cekouts.id as id','cekouts.gambar as gambar', 'cekouts.nama_produk as nama_produk','cekouts.jumlah as jumlah', 'cekouts.total_bayar as total_bayar', 'cekouts.alamat as alamat', 'cekouts.catatan as catatan', 'cekouts.nama_pembeli as nama_pembeli')
        ->join('produks','produks.id','=','cekouts.produk_id')
        ->join('user_penjuals','user_penjuals.id','=','produks.penjual_id')
        ->where('produks.penjual_id', $request->penjual_id)
        ->where('cekouts.status_pesanan', 'dikirim')
        ->get();

        $data=[
            'success' => 1,
            "message"=>"Berhasil ditampilkan",
            "status"=>200,
            "cekout"=>$cekout,
        ];
        return response()->json($cekout);
    }

    public function terima(Request $request){

        //api data cekout untuk halaman petani
        // menampilkan data cekout sesuai id petani

        $cekout= cekout::select('cekouts.id as id','cekouts.gambar as gambar', 'cekouts.nama_produk as nama_produk','cekouts.jumlah as jumlah', 'cekouts.total_bayar as total_bayar', 'cekouts.alamat as alamat', 'cekouts.catatan as catatan', 'cekouts.nama_pembeli as nama_pembeli')
        ->join('produks','produks.id','=','cekouts.produk_id')
        ->join('user_penjuals','user_penjuals.id','=','produks.penjual_id')
        ->where('produks.penjual_id', $request->penjual_id)
        ->where('cekouts.status_pesanan', 'diterima')
        ->get();

        $data=[
            'success' => 1,
            "message"=>"Berhasil ditampilkan",
            "status"=>200,
            "cekout"=>$cekout,
        ];
        return response()->json($cekout);
    }

}
