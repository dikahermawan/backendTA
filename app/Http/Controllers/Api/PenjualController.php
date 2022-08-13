<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjual;
use Illuminate\Support\Facades\Auth;

class PenjualController extends Controller
{
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
