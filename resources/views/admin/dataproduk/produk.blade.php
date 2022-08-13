@extends('layouts.master')

@section('title','Produk RojoTani')

@section('content')

    <div class="card" style="width: 18rem; float: left; margin: 40px;">

        <div class="card-body">
        <img src="{{asset('public/assets/img/jagung.jpg')}}" class="card-img-top" alt="jagung">
            <h5 class="card-title">Jagung Manis</h5>
            <p class="card-text">Rp 55.000,-/kg</p>
            <a href="#" class="btn btn-warning">Detail</a>
            <a href="#" class="btn btn-success">Edit</a>
        </div>
    </div>

    <div class="card" style="width: 18rem; float: left; margin: 40px;">
        <img src="{{asset('public/assets/img/sayurkol.jpg')}}"  class="card-img-top" alt="sayurkol">
        <div class="card-body">
            <h5 class="card-title">Sayur Kol</h5>
            <p class="card-text">Rp 10.000,-/5pcs</p>
            <a href="#" class="btn btn-warning">Detail</a>
            <a href="#" class="btn btn-success">Edit</a>
        </div>
    </div>

    <div class="card" style="width: 18rem; float: left; margin: 40px;">
        <img src="{{asset('public/assets/img/ikan.jpg')}}"  class="card-img-top" alt="Kemeja Putih Hitam Garis">
        <div class="card-body">
            <h5 class="card-title">Ikan Tongkol</h5>
            <p class="card-text">Rp 27.000,-/1kg</p>
            <a href="#" class="btn btn-warning">Detail</a>
            <a href="#" class="btn btn-success">Edit</a>
        </div>
    </div>

    <div class="card" style="width: 18rem; float: left; margin: 40px;">
        <img src="{{asset('public/assets/img/nangka.jpg')}}"  class="card-img-top" alt="Kemeja Simeo">
        <div class="card-body">
            <h5 class="card-title">Buah Nangka</h5>
            <p class="card-text">Rp 50.000,- 1kg</p>
            <a href="#" class="btn btn-warning">Detail</a>
            <a href="#" class="btn btn-success">Edit</a>
        </div>
    </div>

    <div class="card" style="width: 18rem; float: left; margin: 40px;">
        <img src="{{asset('public/assets/img/seladah.jpg')}}"  class="card-img-top" alt="Putih Kerah Batik">
        <div class="card-body">
            <h5 class="card-title">Seladah Air</h5>
            <p class="card-text">Rp 35.000,-</p>
            <a href="#" class="btn btn-warning">Detail</a>
            <a href="#" class="btn btn-success">Edit</a>
        </div>
    </div>

    <div class="card" style="width: 18rem; float: left; margin: 40px;">
        <img src="{{asset('public/assets/img/cabe.jpg')}}"  class="card-img-top" alt="Kemeja Adj Red">
        <div class="card-body">
            <h5 class="card-title">Cabai Keriting</h5>
            <p class="card-text">Rp 75.000,-/kg</p>
            <a href="#" class="btn btn-warning">Detail</a>
            <a href="#" class="btn btn-success">Edit</a>
        </div>
    </div>

@endsection
