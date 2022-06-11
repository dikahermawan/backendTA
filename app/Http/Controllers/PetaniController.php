<?php

namespace App\Http\Controllers;
use App\Models\DataPetani;

use Illuminate\Http\Request;

class PetaniController extends Controller
{
    public function index()
    {
        $datapetani = DataPetani::all();
        return view('admin.datapetani.index', compact('datapetani'));
    }

    public function create()
    {
        return view('admin.datapetani.create');
    }

    public function store(UserdataFormRequest $request)
    {
        $data = $request->validated();

        $petani = new DataPetani;
        $petani->nama = $data['nama'];
        $petani->email = $data['Alamat'];
        $petani->kontak = $data['kontak'];
        $petani->norek = $data['norek'];
        $petani->namarek = $data['namarek'];

        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/datapetani/', $filename);
            $petani->image = $filename;
        }

        $petani->navbar_status = $request->navbar_status == true ? '1':'0';
        $petani->status = $request->status == true ? '1':'0';
        $petani->created_by = Auth::user();
        $petani->save();

        return redirect('admin/datapetani')->with('message','Data Pengguna Berhasil Ditambahkan');
    }
}
