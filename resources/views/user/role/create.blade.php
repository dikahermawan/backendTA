@extends('layouts.master')

@section('title','Data User RojoTani')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header1">
            <h4 class="">Tambah Data Pegawai </h4>

        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            </div>
            @endif

            <form action="{{ url('user/add-role') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Role</label>
                    <input type="text" name="role" class="form-control1">
                </div>

                <!-- <div class="mb-3">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control1">
                </div> -->

                <!-- <div class="mb-3">
                    <label>Role</label> -->
                    <!-- <input type="text" name="role" class="form-control1"> -->
                    <!-- <select id="role" class="form-control1" name="role" value="{{ old('role') }}" required>
                        <option selected></option>
                        <option>Admin</option>
                        <option>Pimpinan</option>
                        <option>Pemilik komoditas</option>
                    </select>
                </div> -->

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
