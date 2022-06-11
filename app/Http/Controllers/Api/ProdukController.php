<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function tambah_produk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required',
            'nama' => 'required',
            'harga'=> 'required',
            'stok'=>'required',
            'satuan'=>'required',
            'jenis'=>'required',
            'deskripsi'=>'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success'   => 0,
                    'pesan'     =>$validator->errors()], 401);
            }

            $image = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('public/storage/app/post-image', $image);


            $produk = new Produk([
            'gambar' =>  $image,
            'nama' => $request->nama,
            'harga'=> $request->harga,
            'stok'=>$request->stok,
            'satuan'=>$request->satuan,
            'jenis'=>$request->jenis,
            'deskripsi'=>$request->deskripsi,
            ]);

$produk->save();
return response()->json([
    'produk' => $produk,
    'success' => true
], 201);
    }

    public function tampil_produk(Produk $produk){
        $data=[
            "msg"=>"Berhasil",
            "status"=>200,
            "data"=>$produk,
        ];
        return response()->json($data);

    }

    public function tampil_semua(){
        $produk=new Produk();
        $produk=$produk->get();
        $data=[
            "msg"=>"Berhasil",
            "status"=>200,
            "data"=>$produk,
            "total"=>$produk->count()
        ];
                return response()->json($data);

            }
}
