<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'id', 
        'tanggal_peminjaman', 
        'durasi_peminjaman',  
        'buku',     
        'pengguna',
     ];
     
     public function getCreatedAtAttribute()
     {
         return Carbon::parse($this->attributes['tanggal_peminjaman'])
         ->translatedFormat('l, d F Y');
     }
}
