<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
