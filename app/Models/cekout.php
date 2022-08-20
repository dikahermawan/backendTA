<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cekout extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    protected $table = "cekouts";
    protected $primaryKey = "id";
    protected $fillable = ['id','pembeli_id','penjual_id','produk_id','nama_produk','gambar','nama_pembeli','no_rekening','jumlah','ongkir','harga','alamat','subtotal','total_bayar','catatan','status_pesanan',];

    public function pembeli()
    {
        return $this->belongsTo(user_pembeli::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function bayar()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
