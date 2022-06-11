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
            'gambar' => 'required',
            'nama' => 'required',
            'harga'=> 'required',
            'stok'=>'required',
            'satuan'=>'required',
            'jenis'=>'required',
            'deskripsi'=>'required',
            'waktu'=>'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success'   => 0,
                    'pesan'     =>$validator->errors()], 401);
            }

            $image = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('public/storage/app/post-image', $image);


            $lelang = new Lelang([
            'gambar' =>  $image,
            'nama' => $request->nama,
            'harga'=> $request->harga,
            'stok'=>$request->stok,
            'satuan'=>$request->satuan,
            'jenis'=>$request->jenis,
            'deskripsi'=>$request->deskripsi,
            'waktu'=>$request->waktu
            ]);

$lelang->save();
return response()->json([
    'lelang' => $lelang,
    'success' => true
], 201);
    }

    public function tampil_lelang(Lelang $lelang){
        $data=[
            "msg"=>"Berhasil",
            "status"=>200,
            "data"=>$lelang,
        ];
        return response()->json($data);

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
}
