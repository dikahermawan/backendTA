@extends('layouts.master')

@section('title','Data User RojoTani')

@section('content')

<div class="container-fluid px-4">

    <!-- <h1 class="mt-4">User Data</h1> -->

    <div class="card mt-4">
        <div class="card-header2">
            <h4>Data Pelanggan
            </h4>
        </div>
        <div class="card-body">
            <div>
                <a class="btn buttonrefresh1">Refresh Data</a>
                <a class="btn buttoncetak"><i class="fas fa-print"></i>  Cetak</a>
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
                        <th>Kontak</th>
                        <th>Role</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;?>
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>Pelanggan RT</td>
                        <td>pelanggan@gmail.com</td>
                        <td>Karangrejo Banyuwangi</td>
                        <td>888888888888</td>
                        <td>Pelanggan Produk Pertanian</td>
                        <td>Image masih kosong</td>
                        <td>
                            <a class="btn btn-success">Edit</a>
                            <a class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
