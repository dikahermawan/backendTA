<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tawar extends Model
{
    use HasFactory;
    protected $table = "tawars";
    protected $primaryKey = "id";
    protected $fillable = ['id','pembeli_id','lelang_id','gambar','nama_pembeli','harga_tawar','alamat','status_tawar',];


    public function pembeli()
    {
        return $this->belongsTo(user_pembeli::class);
    }

    public function lelang()
    {
        return $this->belongsTo(Lelang::class);
    }

}
