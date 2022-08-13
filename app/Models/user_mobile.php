<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class user_mobile extends Model
{
    use HasFactory,HasApiTokens;

    protected $fillable = [
        'gambar',
        'kategori',
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
}
