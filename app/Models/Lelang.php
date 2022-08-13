<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lelang extends Model
{
    use HasFactory;

    protected $table = "lelangs";
    protected $primaryKey = "id";
    protected $fillable = ['id','penjual_id','gambar','nama','harga','satuan','jenis','deskripsi','waktu', 'status'];

    public function penjual()
    {
        return $this->belongsTo(user_penjual::class);
    }
}
