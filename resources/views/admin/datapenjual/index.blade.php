@extends('layouts.master')

@section('title','Data Penjual RojoTani')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header2">
            <h4>Data Penjual
            </h4>
        </div>
        <div class="card-body">
            <div>
                <a class="btn buttonrefresh1" href="{{ url('admin/datapenjual') }}">Refresh Data</a>
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
                        <th>No Rekening</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;?>
                    @foreach ($user_penjuals as $item)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->no_rekening }}</td>
                            <td>
                                <img src="{{ asset('public/public/img/userpenjual/'.$item->gambar) }}" width="40px" height="60px" alt="Img">
                            </td>
                            <td>
                                <a href="{{ url('admin/edit-datapenjual/')}}" class="btn btn-warning">Detail</a>
                                <a href="{{ url('admin/edit-datapenjual/'.$item->id)}}" class="btn btn-success">Edit</a>
                                <a href="{{ url('admin/delete-datapenjual/'.$item->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
