<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\Instruktur;
use Illuminate\Support\Carbon;

class JadwalUmum extends Model
{
    use HasFactory;
    public function kelas()
{
    return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
}

public function instruktur()
{
    return $this->belongsTo(Instruktur::class, 'instruktur_id', 'id');
}
    protected $fillable = [
        // 'id', 
        'hari', 
        'kelas_nama',
        'instruktur_nama',
        'jam',
     ];
    //  public function getCreatedAtAttribute()
    //  {
    //      return Carbon::parse($this->attributes['tanggal_lahir'])
    //      ->translatedFormat('l, d F Y');
    //  }
}
