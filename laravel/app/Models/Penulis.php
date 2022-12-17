<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Penulis extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'id', 
        'nama', 
        'tanggal_lahir',  
        'deskripisi',     
     ];
     public function getCreatedAtAttribute()
     {
         return Carbon::parse($this->attributes['tanggal_lahir'])
         ->translatedFormat('l, d F Y');
     }
}
