<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Produk;

class ProdukController extends Controller
{
    //
    public function tambah_produk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:produks',
            'harga'=> 'required',
            'stok'=>'required',
            'satuan'=>'required',
            'jenis'=>'required',
            'deskripsi'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => 0,
                'message'     =>$validator->errors()], 401);
        }

        $image = $request->file('gambar')->getClientOriginalName();
        $imagepath = $request->file('gambar')->move('img/produk', $image);

        //  if($request->file('gambar')){
            // $image = $request->file('gambar')->getClientOriginalName();
            // $request->file('gambar')->move('public/storage/app/post-image', $image);
            // }
            // $image = null;

        $produk = new Produk([
        'gambar' => $image,
        'penjual_id'=> $request->penjual_id,
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
                'success' => 1,
                'message' => 'Berhasil Ditambahkan'
            ], 201);
    }

    public function tampil_produk(Request $request){
        $produk = new Produk();
        $produk = $produk->where('penjual_id', $request->penjual_id)->get();
        $data=[
            'success' => 1,
            "message"=>"Berhasil ditampilkan",
            "status"=>200,
            "produk"=>$produk,
        ];

        return response()->json($produk);
    }

    public function tampil_semua(){
        $produk=new Produk();
        $produk=$produk->get();
        $data=[
            "message"=>"Berhasil",
            "status"=>200,
            "data"=>$produk,
            "total"=>$produk->count()
        ];
        return response()->json($data);
    }

    public function edit_produk(Request $request){
        $produk = Produk::find($request->produk_id);

        return response()->json($produk);
    }


    public function update_produk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:produks',
            'harga'=> 'required',
            'stok'=>'required',
            'satuan'=>'required',
            'jenis'=>'required',
            'deskripsi'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => 0,
                'message'     =>$validator->errors()], 401);
        }

        // if($request->file('gambar')){
        //     $image = $request->file('gambar')->getClientOriginalName();
        //     $request->file('gambar')->move('public/storage/app/post-image', $image);
        // }
        // $image = null;



        $produk = Produk::find($request->produk_id);
        $produk->nama = $request->nama;
        $produk->harga = $request->harga;
        $produk->satuan = $request->satuan;
        $produk->stok = $request->stok;
        $produk->jenis = $request->jenis;
        $produk->deskripsi = $request->deskripsi;

        $produk->update();
            return response()->json([
                'produk' => $produk,
                'success' => 1,
                'message' => 'Berhasil Ditambahkan'
            ], 201);
    }

    public function deleteProduk($id){
        $produk = Produk::find($id);
        $produk->delete();
        return response()->json(['message'=>'produk berhasil dihapus']);
    }

    // public function deleteProduk(Request $request){
    //     $produk = Produk::find($request->$barang_id);
    //     $produk->delete();
    //     return response()->json(['message'=>'produk berhasil dihapus']);
    // }

}
