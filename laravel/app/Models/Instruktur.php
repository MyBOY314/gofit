<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Instruktur extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'id', 
        'nama_instruktur', 
        'password_instruktur',
        'email',
        'nomor_telepon',
        'terlambat',     
     ];
    //  public function getCreatedAtAttribute()
    //  {
    //      return Carbon::parse($this->attributes['tanggal_lahir'])
    //      ->translatedFormat('l, d F Y');
    //  }
}
