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

            <form action="{{ url('admin/update-userdata/'.$userdata->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama User</label>
                    <input type="text" name="nama" value="{{ $userdata->nama }}" class="form-control1">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="text" name="email" value="{{ $userdata->email }}" class="form-control1">
                </div>

                <div class="mb-3">
                    <label>Role</label>
                    <input type="text" name="role" value="{{ $userdata->role }}" class="form-control1">
                </div>

                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control1">
                </div>

                <h6>RojoTani SEO Tags</h6>
                <div class="mb-3">
                    <label>Meta Title</label>
                    <input type="text" name="meta_title" value="{{ $userdata->meta_title }}" class="form-control1">
                </div>
                <div class="mb-3">
                    <label>Meta Description</label>
                    <textarea name="meta_description" rows="3" class="form-control1"> {{ $userdata->meta_description }} </textarea>
                </div>
                <div class="mb-3">
                    <label>Meta Keyword</label>
                    <textarea name="meta_keyword" rows="3" class="form-control1"> {{ $userdata->meta_keyword }} </textarea>
                </div>

                <h6>RojoTani Status Mode</h6>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label>Navbar Status</label>
                        <input type="checkbox" name="navbar_status" {{ $userdata->navbar_status == '1' ? 'checked':''}} />
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Status</label>
                        <input type="checkbox" name="status" {{ $userdata->status == '1' ? 'checked':''}} />
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
