@extends('layouts.master')

@section('title','Data Pembeli RojoTani')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header2">
            <h4>Data Pembeli
            </h4>
        </div>
        <div class="card-body">
            <div>
                <a class="btn buttonrefresh1" href="{{ url('admin/datapembeli') }}">Refresh Data</a>
                <a class="btn buttoncetak2"><i class="fas fa-print"></i>  Cetak</a>
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
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;?>
                    @foreach ($user_pembelis as $item)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>
                                <img src="{{ asset('public/public/img/userpembeli/'.$item->gambar) }}" width="50px" height="50px" alt="Img">    
                            </td>
                            <td>
                                <a href="{{ url('admin/edit-pembeli')}}" class="btn btn-warning">Detail</a>
                                <a href="{{ url('admin/edit-datapembeli/'.$item->id)}}" class="btn btn-success">Edit</a>
                                <a href="{{ url('admin/delete-datapembeli/'.$item->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
