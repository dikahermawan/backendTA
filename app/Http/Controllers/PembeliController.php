<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\user_pembeli;
use Validator;

class PembeliController extends Controller
{
    public function index()
    {
        $user_pembelis = user_pembeli::all();
        return view('admin.datapembeli.index', compact('user_pembelis'));
    }

    public function edit_userpembeli(Request $request){
        $userpembeli = user_pembeli::find($request->userpembeli_id);
        return view('admin.datapembeli.edit', compact('userpembeli'));
    }

    public function update_userpembeli(Request $request)
    {
        $userpembeli = user_pembeli::find($request->userpembeli_id);
        $userpembeli->nama = $request->nama;
        $userpembeli->alamat = $request->alamat;
        $userpembeli->email = $request->email;

        if ($request->hasfile('gambar')) {

            $destination = 'public/img/userpembeli/' . $userpembeli->gambar;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $image = $request->file('gambar')->getClientOriginalName();
            $imgpath= $request->file('gambar')->move('public/img/userpembeli/', $image);
        }

        $userpembeli->update();
        return redirect('admin/datapembeli')->with('message', 'Data Pengguna Berhasil Diubah');

    }

    public function delete_userpembeli($userpembeli_id)
    {
        $userpembeli = user_pembeli::find($userpembeli_id);
        if ($userpembeli) {
            $destination = 'public/img/userpembeli/' . $userpembeli->gambar;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $userpembeli->delete();
            return redirect('admin/datapembeli')->with('message', 'Data Pengguna Berhasil Dihapus');
        } else {
            return redirect('admin/datapembeli')->with('message', 'Data Pengguna Id Tidak Ditemukan');
        }
    }

    public function get_all(){
        $user=new user_pembeli();
        $user=$user->get();
        $data=[
            "msg"=>"Berhasil",
            "status"=>200,
            "data"=>$user,
            "total"=>$user->count()
        ];
        return response()->json($data);
    }
}
