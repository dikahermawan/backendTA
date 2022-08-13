<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class user_pembeli extends Model
{
    use HasFactory,HasApiTokens;
    protected $table = "user_pembelis";
    protected $fillable = [
        'gambar',
        'nama',
        'alamat',
        'email',
        'password',
     ];

     protected $hidden = [
         'password',
         'remember_token',
     ];

     protected $casts = [
         'email_verified_at' => 'datetime',
     ];

    public function cekout()
    {
        return $this->hasMany(cekout::class);
    }

    public function bayar()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function tawar()
    {
        return $this->hasMany(Tawar::class);
    }

}
