@extends('layouts.master')

@section('title','Data User RojoTani')

@section('content')

<div class="container-fluid px-4">

    <!-- <h1 class="mt-4">User Data</h1> -->

    <div class="card mt-4">
        <div class="card-header2">
            <h4>Data Pegawai
                <!-- <a href="{{ url('admin/add-userdata') }}" class="btn btn-primary btn-sm float-end"><i class="fas fa-plus"></i> Tambah Data Pegawai</a> -->
            </h4>
        </div>
        <div class="card-body">
            <div>
                <a href="{{ url('admin/add-userdata') }}" class="btn buttontambah"><i class="fas fa-plus"></i>  Tambah Data Pegawai</a>
                <a class="btn buttoncetak1"><i class="fas fa-print"></i>  Cetak</a>
                <input type="search" placeholder="Search..." class="searchkotak"/>
                <button class="buttonsearch"><i class="fa fa-search"></i></button>
            </div>

            @if (session('message'))
                <div class="alert alert-success">{{ (session('message')) }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;?>
                    @foreach ($role as $item)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->role }}</td>
                        <td>
                            <img src="{{ asset('public/uploads/userdata/'.$item->image) }}" width="50px" height="50px" alt="Img">
                        </td>
                        <td>{{ $item->status == '1' ? 'Hidden':'Shown' }}</td>
                        <td>
                            <a href="{{ url('admin/edit-userdata/'.$item->id)}}" class="btn btn-success">Edit</a>
                            <a href="{{ url('admin/delete-userdata/'.$item->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
