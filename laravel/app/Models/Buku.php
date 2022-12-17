<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'id', 
        'nama', 
        'tahun_terbit',  
        'synopsis',     
        'genre',
        'harga',
        'penulis',
     ];

     public function getCreatedAtAttribute()
     {
         return Carbon::parse($this->attributes['tahun_terbit'])
         ->translatedFormat('l, d F Y');
     }

}
