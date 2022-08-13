@extends('layouts.master')

@section('title','Data User RojoTani')

@section('content')

<div class="container-fluid px-4">



    <div class="card mt-4">
        <div class="card-header1">
            <h4 class="">Edit User Data </h4>

        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            </div>
            @endif

            <form action="{{ url('admin/update-datapetani/'.$datapetani->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama User</label>
                    <input type="text" name="nama" value="{{ $datapetani->nama }}" class="form-control1">
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <input type="text" name="alamat" value="{{ $datapetani->alamat }}" class="form-control1">
                </div>

                <div class="mb-3">
                    <label>Kontak</label>
                    <input type="text" name="kontak" value="{{ $datapetani->kontak }}" class="form-control1">
                </div>

                <div class="mb-3">
                    <label>Nomor Rekening</label>
                    <input type="text" name="norek" value="{{ $datapetani->norek }}" class="form-control1">
                </div>

                <div class="mb-3">
                    <label>Nama Rekening</label>
                    <input type="text" name="namarek" value="{{ $datapetani->namarek }}" class="form-control1">
                </div>

                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control1">
                </div>

                <h6>RojoTani Status Mode</h6>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label>Navbar Status</label>
                        <input type="checkbox" name="navbar_status" {{ $datapetani->navbar_status == '1' ? 'checked':''}} />
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Status</label>
                        <input type="checkbox" name="status" {{ $datapetani->status == '1' ? 'checked':''}} />
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
