@extends('layouts.master')

@section('title','Data User RojoTani')

@section('content')

<div class="container-fluid px-4">

    <!-- <h1 class="mt-4">User Data</h1> -->

    <div class="card mt-4">
        <div class="card-header2">
            <h4>Laporan Transaksi
            </h4>
        </div>
        <div class="card-body">
            <div>
            <a class="btn buttontambah"><i class="fas fa-plus"></i>  Tambah Laporan</a>
                <a class="btn buttonrefresh1">Refresh Data</a>
            </div>


            @if (session('message'))
                <div class="alert alert-success">{{ (session('message')) }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Produk</th>
                        <th>Id Pesanan</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Pesan</th>
                        <th>Alamat</th>
                        <th>Produk</th>
                        <th>Jumlah Produk</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;?>
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
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
