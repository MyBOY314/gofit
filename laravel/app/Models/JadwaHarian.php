<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\Instruktur;
use App\Models\JadwalUmum;
use Illuminate\Support\Carbon;

class JadwalHarian extends Model
{
    use HasFactory;
    public function kelas()
    {
        return $this->belongsTo(JadwalUmum::class,'jadwal_id', 'id');
    }

    public function instruktur()
{
    return $this->belongsTo(Instruktur::class, 'instruktur_id', 'id');
}
    protected $fillable = [
        // 'id', 
        'tanggal', 
        'jadwal_harian',
        'instruktur_nama',
        'status',
     ];
    //  public function getCreatedAtAttribute()
    //  {
    //      return Carbon::parse($this->attributes['tanggal_lahir'])
    //      ->translatedFormat('l, d F Y');
    //  }
}
