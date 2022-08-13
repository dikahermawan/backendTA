<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class user_penjual extends Model
{
    use HasFactory,HasApiTokens;
    protected $table = "user_penjuals";
    protected $fillable = [
        'gambar',
        'nama',
        'alamat',
        'email',
        'password',
        'no_rekening'
     ];

     protected $hidden = [
         'password',
         'remember_token',
     ];

     protected $casts = [
         'email_verified_at' => 'datetime',
     ];

     public function produk()
     {
         return $this->hasMany(Produk::class);
     }
     public function lelang()
     {
         return $this->hasMany(Lelang::class);
     }
}
