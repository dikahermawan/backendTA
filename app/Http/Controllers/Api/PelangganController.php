<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function register_pelanggan(Request $request){
        $validator = Validator::make($request->all(), [
        'nama' => 'required',
        'alamat' => 'required',
        'no_rekening' => 'required',
        'email' => 'required|unique:pelanggans',
        'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => 0,
                'pesan'     =>$validator->errors()], 401);
        }

        $pelanggan = new Pelanggan([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_rekening' => $request->no_rekening,
            'email' => $request->email,
            'password' => bcrypt($request->password),

        ]);

        //cek pada program anda, jika belum ada, anda bisa menambahkan
        // success seperti perintah baris 33
        $pelanggan->save();
        return response()->json([
            'pelanggan' => $pelanggan,
            'success' => true
        ], 201);
    }

    public function login_pelanggan(Request $request) {
        $validataData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $login_detail = request(['email', 'password']);

        if(!Auth::attempt($login_detail)){
            return response()->json(['error' => 'login failed!']);
        }

        $user = $request->user();

        $tokenResult = $user->createToken('AccessToken');
        $token = $tokenResult->token;
        $token->save();

        //pada login belum memiliki key sukses maka harus ditambahi
        //tambahi key token dan user sesuai pada api.dart agar dapat digunakan

        return response()->json([
            'access_token' => 'Bearer' . $tokenResult->accessToken,
            'token_id' => $token->id,
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'success' => true,
            'token' => $tokenResult->accessToken,
            'user' => $user->name
        ], 200);
    }
    // end login

    //Logout
    //berikut adalah tambahan logout function
    //kemudian tambahkan ke route api
    public function logout_pelanggan(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Logout Berhasil',
        ]);
    }


    public function get(Pelanggan $pelanggan){
        $data=[
            "msg"=>"Berhasil",
            "status"=>200,
            "data"=>$pelanggan,
        ];
        return response()->json($data);
    }

    public function get_all(){
        $pelanggan=new Pelanggan();
        $pelanggan=$pelanggan->get();
        $data=[
            "msg"=>"Berhasil",
            "status"=>200,
            "data"=>$pelanggan,
            "total"=>$pelanggan->count()
        ];
        return response()->json($data);
    }

    public function delete(Pelanggan $pelanggan){
        $pelanggan->delete();
        $data=[
            "msg"=>"data telah di hapus",
            "status"=>200,
        ];
        return response()->json($data);
    }

    public function update(Pelanggan $pelanggan){
        $pelanggan->update([
            'password' =>  bcrypt($pelanggan->password),
        ]);

        return response()->json($pelanggan, 201);
    }
}

