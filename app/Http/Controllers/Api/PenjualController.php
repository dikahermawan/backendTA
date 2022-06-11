<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Penjual;

class PenjualController extends Controller
{

public function register_penjual(Request $request){
    $validator = Validator::make($request->all(), [
    'nama' => 'required',
    'alamat' => 'required',
    'no_rekening' => 'required',
    'email' => 'required|unique:penjuals',
    'password' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success'   => 0,
            'pesan'     =>$validator->errors()], 401);
    }

$penjual = new Penjual([
    'nama' => $request->nama,
    'alamat' => $request->alamat,
    'no_rekening' => $request->no_rekening,
    'email' => $request->email,
    'password' => bcrypt($request->password),

]);

//cek pada program anda, jika belum ada, anda bisa menambahkan
// success seperti perintah baris 33
$penjual->save();
return response()->json([
    'penjual' => $penjual,
    'success' => true
], 201);

}



public function get(Penjual $penjual){
    $data=[
        "msg"=>"Berhasil",
        "status"=>200,
        "data"=>$penjual,
    ];
    return response()->json($data);

}
    public function get_all(){
$penjual=new Penjual();
$penjual=$penjual->get();
$data=[
    "msg"=>"Berhasil",
    "status"=>200,
    "data"=>$penjual,
    "total"=>$penjual->count()
];
        return response()->json($data);

    }

    public function delete(Penjual $penjual){
        $penjual->delete();
        $data=[
            "msg"=>"data telah di hapus",
            "status"=>200,
        ];
                return response()->json($data);
        }

        public function update(Penjual $penjual){
            $penjual->update([
                'password' =>  bcrypt($penjual->password),
            ]);

        return response()->json($penjual, 201);
}
}
