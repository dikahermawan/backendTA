<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPetani extends Model
{
    use HasFactory;

    protected $table = 'datapetani';

    protected $fillable = [
        'nama',
        'alamat',
        'kontak',
        'norek',
        'namarek',
        'image',
        'navbar_status',
        'status',
        'created_by',
    ];
}
