<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_penjual;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserPenjualController extends Controller
{
    //
    public function register_penjual(Request $request){
        $validator = Validator::make($request->all(), [
        'nama' => 'required',
        'alamat' => 'required',
        'no_rekening' => 'required',
        'email' => 'required|unique:user_penjuals',
        'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => 0,
                'pesan'     =>$validator->errors()], 401);
        }
        $image = $request->file('gambar')->getClientOriginalName();
        $imgpath = $request->file('gambar')->move('img/userpenjual', $image);

        $user = new user_penjual([
            'gambar' => $image,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_rekening' => $request->no_rekening,
            'email' => $request->email,
            'password' =>  bcrypt($request->password),
        ]);

        //cek pada program anda, jika belum ada, anda bisa menambahkan
        // success seperti perintah baris 33
        $user->save();
        return response()->json([
            'user' => $user,
            'success' => 1
        ], 201);
    }

    public function login_penjual(Request $request){
        // validasi login
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // pengondisian error
        if ($validator->fails()) {
            $val = $validator->errors()->first();
            return $this->error($val);
        }

    // proses login
    $user = user_penjual::where('email', $request->email)->first();
    if ($user) {
        if (password_verify($request->password, $user->password)) {

                $tokenResult    = $user->createToken('AccessToken');
                $token          = $tokenResult->token;
                $token->save();

                return response()->json([
                    'success'       => 1,
                    'message'       => 'selamat datang ' . $user->nama,
                    'access_token'  => $tokenResult->accessToken,
                    'token_id'      => $token->id,
                    'user'        => $user,
                    'penjual_id'        => (string)$user->id,
                ]);
            }
            return $this->error('Password Salah');
        }
        return $this->error('Anda Tidak Terdaftar');
    }

    // public function get_penjual($id){
    //     $user = user_penjual::find($id);
    //     $data=[
    //         "msg"=>"Berhasil",
    //         "status"=>200,
    //         "data"=>$user,
    //     ];
    //     return response()->json($data);
    // }

    public function get_penjual(Request $request){
        $user = user_penjual::find($request->penjual_id);

        $data=[
            "user"=>$user,
        ];
         return response()->json($user);

    }

    public function get_all(){
        $user=new user_penjual();
        $user=$user->get();
        $data=[
            "msg"=>"Berhasil",
            "status"=>200,
            "data"=>$user,
            "total"=>$user->count()
        ];
        return response()->json($data);
    }

    public function delete(user_penjual $user){
        $user->delete();
        $data=[
            "msg"=>"data telah di hapus",
            "status"=>200,
        ];
                return response()->json($data);
    }

    public function edit_profil(Request $request){
        $penjual = user_penjual::find($request->penjual_id);
        return response()->json($penjual);
    }

    public function updateProfil(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'=> 'required',
            'alamat'=> 'required',
            // 'no_rekening'=> 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => 0,
                'message'     =>$validator->errors()], 401);
        }

        $gambar1 = $request->file('gambar')->getClientOriginalName();
        $pathimage = $request->file('gambar')->move('img/userpenjual', $gambar1);

        $penjual = user_penjual::find($request->penjual_id);
        $penjual->nama = $request->nama;
        $penjual->gambar = $gambar1;

        $penjual->alamat =  $request->alamat;
        // $penjual->no_rekening =  $request->no_rekening;
        $penjual->update();

        return response()->json([
            'penjual' => $penjual,
            'success' => 1,
            'message' => 'Berhasil Ditambahkan'
        ], 201);
    }


    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'email' => 'required|unique:user_penjuals',
            'password'=> 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => 0,
                'message'     =>$validator->errors()], 401);
        }

        $penjual = user_penjual::find($request->penjual_id);
        // $penjual->email = $request->email;
        $penjual->password =  bcrypt($request->password);
        $penjual->update();

        return response()->json([
            'penjual' => $penjual,
            'success' => 1,
            'message' => 'Berhasil Ditambahkan'
        ], 201);
    }
    public function error($pesan)
    {
        return response()->json([
            'success' => 0,
            'message' => $pesan
        ]);
    }

}
