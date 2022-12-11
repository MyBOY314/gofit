<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penulis extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'id', 
        'nama', 
        'tanggal_lahir',  
        'deskripisi',     
     ];
    
}
