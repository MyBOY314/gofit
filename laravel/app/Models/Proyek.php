<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Proyek extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_proyek',
        'id_departemen',
        'waktu_mulai',
        'waktu_selesai',
        'status',
    ];
    
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['waktu_mulai'])
        ->translatedFormat('l, d F Y');
    }


}
