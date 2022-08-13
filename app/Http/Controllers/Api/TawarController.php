<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\user_pembeli;
use App\Models\Lelang;
use App\Models\Tawar;

class TawarController extends Controller
{
    public function tawar(Request $request){
        $lelang = Lelang::find($request->lelang_id);
        $pembeli = user_pembeli::find($request->pembeli_id);

        $data=[
            'success' => 1,
            "message"=>"Berhasil ditampilkan",
            "status"=>200,
            "lelang"=>$lelang,
            "pembeli"=>$pembeli,

        ];
        // return response()->json($produk);
        return response()->json([
            "lelang"=>$lelang,
            "pembeli"=>$pembeli,
        ], 200);
    }

    public function tambah_tawar(Request $request)
    {
        // proses validasi
        $validator = Validator::make($request->all(),[
            'harga_tawar'             => 'required|unique:tawars',
        ]);

        // pengondisian error
        if ($validator->fails()) {
            return response()->json([
                'success'   => 0,
                'pesan'     =>$validator->errors()], 401);
        }

        //proses input data cekout baru
        $lelang = Lelang::find($request->lelang_id);
        $pembeli = user_pembeli::find($request->pembeli_id);

        $alamat = $pembeli->alamat;
        $nama_pembeli = $pembeli->nama;

        $gambar = $lelang->gambar;


        $tawar = Tawar::create([
            'pembeli_id'     => $request->pembeli_id,
            'lelang_id'      => $request->lelang_id,
            'alamat'         => $alamat,
            'nama_pembeli'   => $nama_pembeli,
            'gambar'         => $gambar,
            'harga_tawar'    => $request->harga_tawar,

            // 'status_tawar' => $request->input('status_pesanan'),
        ]);

        // pengondisian sukses
        if ($tawar) {
            return response()->json([
                'success'   => 1,
                'message'   => 'Tawar Produk Berhasil Ditambahkan',
                'tawar'     => $tawar,
                'lelang'    => $lelang,
                'pembeli'   => $pembeli,
                'tawar_id'  => (string)$tawar->id,
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'message' => 'Cekout Produk Gagal Ditambahkan',
            ], 401);
        }
    }

    public function deletetawar($id){
        $tawar = Tawar::find($id);
        $tawar->delete();
        return response()->json(['message'=>'Tawaran berhasil dihapus']);
    }



}
