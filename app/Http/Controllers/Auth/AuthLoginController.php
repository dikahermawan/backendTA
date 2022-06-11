<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthLoginController extends Controller
{
    public function register (Request $req) {
        $validataData = $req->validate([
            'name' => 'required|max:25',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        //create user
        $user = new User([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password),

        ]);

        //cek pada program anda, jika belum ada, anda bisa menambahkan
        // success seperti perintah baris 33

        $user->save();
        return response()->json([
            'user' => $user,
            'success' => true
        ], 201);
    }
    //end of register

    public function login(Request $request) {
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
    public function logout(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Logout Berhasil',
        ]);
    }
}

