<?php

namespace App\Http\Controllers;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UserdataFormRequest;


class UserdataController extends Controller
{
    //
    public function index()
    {
        $userdata = UserData::all();
        return view('admin.userdata.index', compact('userdata'));
    }

    public function create()
    {
        return view('admin.userdata.create');
    }

    public function store(UserdataFormRequest $request)
    {
        $data = $request->validated();

        $user = new UserData;
        $user->nama = $data['nama'];
        $user->email = $data['email'];
        $user->role = $data['role'];

        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/userdata/', $filename);
            $user->image = $filename;
        }

        $user->meta_title = $data['meta_title'];
        $user->meta_description = $data['meta_description'];
        $user->meta_keyword = $data['meta_keyword'];

        $user->navbar_status = $request->navbar_status == true ? '1':'0';
        $user->status = $request->status == true ? '1':'0';
        $user->created_by = Auth::user();
        $user->save();

        return redirect('admin/userdata')->with('message','Data Pengguna Berhasil Ditambahkan');
    }

    public function edit($userdata_id)
    {
        $userdata = Userdata::find($userdata_id);
        return view('admin.userdata.edit', compact('userdata'));
    }

    public function update(UserdataFormRequest $request, $userdata_id)
    {
        $data = $request->validated();

        $user = UserData::find($userdata_id);
        $user->nama = $data['nama'];
        $user->email = $data['email'];
        $user->role = $data['role'];

        if($request->hasfile('image')){

            $destination = 'uploads/userdata/'.$user->image;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/userdata/', $filename);
            $user->image = $filename;
        }

        $user->meta_title = $data['meta_title'];
        $user->meta_description = $data['meta_description'];
        $user->meta_keyword = $data['meta_keyword'];

        $user->navbar_status = $request->navbar_status == true ? '1':'0';
        $user->status = $request->status == true ? '1':'0';
        $user->created_by = Auth::user();
        $user->update();

        return redirect('admin/userdata')->with('message','Data Pengguna Berhasil Diubah');
    }

    public function destroy($userdata_id)
    {
        $userdata = Userdata::find($userdata_id);
        if($userdata)
        {
            $destination = 'uploads/userdata/'.$userdata->image;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $userdata->delete();
            return redirect('admin/userdata')->with('message','Data Pengguna Berhasil Dihapus');
        }
        else
        {
            return redirect('admin/userdata')->with('message','Data Pengguna Id Tidak Ditemukan');
        }
    }
}
