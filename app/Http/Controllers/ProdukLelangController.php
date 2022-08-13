<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukLelangController extends Controller
{
    //
    public function index()
    {
        return view('admin.dataproduk.produklelang');
    }
}
