<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class RoleController extends Controller
{
    //
    public function index()
    {
        $role = Role::all();
        return view('user.role.index', compact('role'));
    }

    public function create()
    {
        return view('user.role.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'role' => 'required',
        ]);

        $role = new Role;
        $role->role = $request->role;
        $role->save();

        return redirect('user/role')->with('message','Data Pengguna Berhasil Ditambahkan');
    }

    public function edit($role_id)
    {
        $role = Role::find($role_id);
        return view('roles.edit', compact('roles'));
    }

    public function update(Request $request, $role_id)
    {
        $this->validate($request, [
            'role' => 'required',
        ]);

        $role = Role::find($role_id);
        $role->role = $request->role;

        $role->update();

        return redirect('roles')->with('message','Data Pengguna Berhasil Diubah');
    }

    public function destroy($role_id)
    {
        $role = Role::find($role_id);
        if($role)
        {
            $role->delete();
            return redirect('roles')->with('message','Data Pengguna Berhasil Dihapus');
        }
        else
        {
            return redirect('roles')->with('message','Data Pengguna Id Tidak Ditemukan');
        }
    }
}
