<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_mobile;
use Illuminate\Support\Facades\Auth;
use Validator;


class UserMobileController extends Controller
{
    public function register_penjual(Request $request){
        $validator = Validator::make($request->all(), [
        'nama' => 'required',
        'alamat' => 'required',
        'no_rekening' => 'required',
        'email' => 'required|unique:user_mobiles',
        'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => 0,
                'pesan'     =>$validator->errors()], 401);
        }

        $user = new user_mobile([
            'gambar' => $request->gambar,
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'alamat' => $request->alamat,
            'no_rekening' => $request->no_rekening,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        //cek pada program anda, jika belum ada, anda bisa menambahkan
        // success seperti perintah baris 33
        $user->save();
        return response()->json([
            'user' => $user,
            'success' => true
        ], 201);
    }

    public function login(Request $request){
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
    $user = user_mobile::where('email', $request->email)->first();
    if ($user) {
        if (password_verify($request->password, $user->password)) {
            if ($user->kategori== 'petani') {

            $tokenResult    = $user->createToken('AccessToken');
            $token          = $tokenResult->token;
            $token->save();

            return response()->json([
                'success'       => 1,
                'message'       => 'selamat datang petani ' . $user->nama,
                'access_token'  => $tokenResult->accessToken,
                'token_id'      => $token->id,
                'user'        => $user
            ]);
            }

                $tokenResult    = $user->createToken('AccessToken');
                $token          = $tokenResult->token;
                $token->save();

                return response()->json([
                    'success'       => 1,
                    'message'       => 'selamat datang pelanggan ' . $user->nama,
                    'access_token'  => $tokenResult->accessToken,
                    'token_id'      => $token->id,
                    'user'        => $user
                ]);
            }
            return $this->error('Password Salah');
        }
        return $this->error('Anda Tidak Terdaftar');
    }

    public function get(user_mobile $user){
        $data=[
            "msg"=>"Berhasil",
            "status"=>200,
            "data"=>$user,
        ];
        return response()->json($data);
    }

    public function get_all(){
        $user=new user_mobile();
        $user=$user->get();
        $data=[
            "msg"=>"Berhasil",
            "status"=>200,
            "data"=>$user,
            "total"=>$user->count()
        ];
        return response()->json($data);
    }

    public function delete(user_mobile $user){
        $user->delete();
        $data=[
            "msg"=>"data telah di hapus",
            "status"=>200,
        ];
                return response()->json($data);
    }

    public function update(user_mobile $user){
        $user->update([
            'password' =>  bcrypt($user->password),
        ]);
        return response()->json($user, 201);
    }

    public function error($pesan)
    {
        return response()->json([
            'success' => 0,
            'message' => $pesan
        ]);
    }
}
