<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = "pembayarans";
    protected $primaryKey = "id";
    protected $fillable = ['id','cekout_id','pembeli_id','gambar','nama_pembeli','harga','ongkir','subtotal','jumlah','total_bayar','no_rekening','alamat','status_pembayaran',];

    public function cekout()
    {
        return $this->belongsTo(cekout::class);
    }

    public function pembeli()
    {
        return $this->belongsTo(user_pembeli::class);
    }

}
