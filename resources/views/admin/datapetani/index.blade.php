@extends('layouts.master')

@section('title','Data User RojoTani')

@section('content')

<div class="container-fluid px-4">

    <!-- <h1 class="mt-4">User Data</h1> -->

    <div class="card mt-4">
        <div class="card-header2">
            <h4>Data Pemilik Komoditas</h4>
        </div>
        <div class="card-body">
            <div>
                <a href="{{ url('admin/add-datapetani') }}" class="btn buttontambah"><i class="fas fa-plus"></i>Tambah Data</a>
            </div>
            <div>
                <a class="btn buttonrefresh">Refresh Data</a>
            </div>

            @if (session('message'))
                <div class="alert alert-success">{{ (session('message')) }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Kontak</th>
                        <th>Nomor Rekening</th>
                        <th>Nama Rekening</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;?>
                    @foreach ($userdata as $item)
                    <tr>
                        <td>{{ ++$no; }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->kontak }}</td>
                        <td>{{ $item->norek }}</td>
                        <td>{{ $item->namarek }}</td>
                        <td>
                            <img src="{{ asset('uploads/datapetani/'.$item->image) }}" width="50px" height="50px" alt="Img">
                        </td>
                        <td>{{ $item->status == '1' ? 'Hidden':'Shown' }}</td>
                        <td>
                            <a href="{{ url('admin/edit-datapetani/'.$item->id)}}" class="btn btn-success">Edit</a>
                            <a href="{{ url('admin/delete-datapetani/'.$item->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection
