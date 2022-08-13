<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\tambah_stok;

class TambahStokController extends Controller
{
    public function tambah_stok(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'produk_id'=>'required',
            'stok'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => 0,
                'pesan'     =>$validator->errors()], 401);
        }

        $tambah_stok = new tambah_stok([
            'produk_id'=>$request->produk_id,
            'stok'=>$request->stok
        ]);

        $tambah_stok->save();
        return response()->json([
            'tambah_stok' => $tambah_stok,
            'success' => true
        ], 201);
    }

    public function hapus_stok(tambah_stok $hapus_stok){
        $hapus_stok->delete();
        $data=[
            "msg"=>"data telah di hapus",
            "status"=>200,
        ];
                return response()->json($data);
        }


}
