<?php

namespace App\Http\Controllers;
use App\Models\DataPetani;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\DatapetaniFormRequest;
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

    public function store(DatapetaniFormRequest $request)
    {
        $data = $request->validated();

        $petani = new DataPetani;
        $petani->nama = $data['nama'];
        $petani->alamat = $data['alamat'];
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

    public function edit($datapetani_id)
    {
        $datapetani = DataPetani::find($datapetani_id);
        return view('admin.datapetani.edit', compact('datapetani'));
    }

    public function update(DatapetaniFormRequest $request, $datapetani_id)
    {
        $data = $request->validated();

        $petani = datapetani::find($datapetani_id);
        $petani->nama = $data['nama'];
        $petani->alamat = $data['alamat'];
        $petani->kontak = $data['kontak'];
        $petani->norek = $data['norek'];
        $petani->namarek = $data['namarek'];

        if($request->hasfile('image')){

            $destination = 'uploads/datapetani/'.$petani->image;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/datapetani/', $filename);
            $petani->image = $filename;
        }

        $petani->navbar_status = $request->navbar_status == true ? '1':'0';
        $petani->status = $request->status == true ? '1':'0';
        $petani->created_by = Auth::user();
        $petani->update();

        return redirect('admin/datapetani')->with('message','Data Pengguna Berhasil Diubah');
    }

    public function destroy($datapetani_id)
    {
        $datapetani = datapetani::find($datapetani_id);
        if($datapetani)
        {
            $destination = 'uploads/datapetani/'.$datapetani->image;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $datapetani->delete();
            return redirect('admin/datapetani')->with('message','Data Pengguna Berhasil Dihapus');
        }
        else
        {
            return redirect('admin/datapetani')->with('message','Data Pengguna Id Tidak Ditemukan');
        }
    }
}
