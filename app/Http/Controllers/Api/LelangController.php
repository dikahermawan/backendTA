<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Lelang;

class LelangController extends Controller
{
    public function tambah_lelang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'gambar' => 'required',
            'nama' => 'required|unique:lelangs',
            'harga'=> 'required',
            'satuan'=>'required',
            'jenis'=>'required',
            'deskripsi'=>'required',
            'status'=>'required',
            // 'waktu'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => 0,
                'pesan'     =>$validator->errors()], 401);
        }

        $images = $request->file('gambar')->getClientOriginalName();
        $imagepath1 = $request->file('gambar')->move('imglelang/lelang', $images);

        $lelang = new Lelang([
        'gambar' =>  $images,
        'penjual_id'=> $request->penjual_id,
        'nama' => $request->nama,
        'harga'=> $request->harga,
        'satuan'=>$request->satuan,
        'jenis'=>$request->jenis,
        'deskripsi'=>$request->deskripsi,
        'status'=>$request->status,
        // 'waktu'=>$request->waktu
        ]);

        $lelang->save();
        return response()->json([
            'lelang' => $lelang,
            'success' => 1,
            'message' => 'Berhasil Ditambahkan'
        ], 201);
    }

    public function tampil_lelang(Request $request){
        $lelang = new Lelang();
        $lelang = $lelang->where('penjual_id', $request->penjual_id)->get();
        $data=[
            'success' => 1,
            "message"=>"Berhasil ditampilkan",
            "status"=>200,
            "lelang"=>$lelang,
        ];

        return response()->json($lelang);
    }

    public function tampil_semua(){
        $lelang=new Lelang();
        $lelang=$lelang->get();
        $data=[
            "msg"=>"Berhasil",
            "status"=>200,
            "data"=>$lelang,
            "total"=>$lelang->count()
        ];
        return response()->json($data);

    }

    public function edit_lelang(Request $request){
        $lelang = Lelang::find($request->lelang_id);

        return response()->json($lelang);
    }

    public function update_lelang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:produks',
            'harga'=> 'required',
            'satuan'=>'required',
            'jenis'=>'required',
            'deskripsi'=>'required',
            'status'=>'required',
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



        $lelang = Lelang::find($request->lelang_id);
        $lelang->nama = $request->nama;
        $lelang->harga = $request->harga;
        $lelang->satuan = $request->satuan;
        $lelang->jenis = $request->jenis;
        $lelang->deskripsi = $request->deskripsi;
        $lelang->status = $request->status;


        $lelang->update();
            return response()->json([
                'lelang' => $lelang,
                'success' => 1,
                'message' => 'Berhasil Ditambahkan'
            ], 201);
    }

    public function deletelelang($id){
        $lelang = Lelang::find($id);
        $lelang->delete();
        return response()->json(['message'=>'produk berhasil dihapus']);
    }

}
