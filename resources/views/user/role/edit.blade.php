@extends('layouts.master')

@section('title','Role User RojoTani')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header1">
            <h4 class="">Edit Role Pengguna</h4>

        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            </div>
            @endif

            <form action="{{ url('user/update-role/'.$role->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Role</label>
                    <input type="text" name="role" value="{{ $user->role }}" class="form-control1">
                </div>

                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control1">
                </div>

                </div>
            </form>
        </div>
    </div>
</div>

@endsection
