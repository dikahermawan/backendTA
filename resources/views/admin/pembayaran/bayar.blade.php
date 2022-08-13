@extends('layouts.master')

@section('title','Data User RojoTani')

@section('content')

<div class="container-fluid px-4">

    <!-- <h1 class="mt-4">User Data</h1> -->

    <div class="card mt-4">
        <div class="card-header2">
            <h4>Data Pembayaran Pesanan
            </h4>
        </div>
        <div class="card-body">
            <div>
                <a class="btn buttonrefresh1">Refresh Data</a>
                <input type="search" placeholder="Search..." class="searchkotak2"/>
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
                        <th>Nama Produk</th>
                        <th>Total Pembayaran</th>
                        <th>Bukti Pembayaran</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;?>
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>Pelanggan 3</td>
                        <td>pel3@gmail.com</td>
                        <td>Karangrejo</td>
                        <td>888888</td>
                        <td>Jagung Manis</td>
                        <td>Rp35,000,00</td>
                        <td>Image kosong</td>
                        <td>Belum validasi</td>
                        <td>
                            <a class="btn btn-success">Validasi</a>
                            <a class="btn btn-warning">Detail</a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
