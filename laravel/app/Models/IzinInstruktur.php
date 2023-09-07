<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\Instruktur;
use App\Models\Kelas;

class IzinInstruktur extends Model
{
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
    public function instruktur()
{
    return $this->belongsTo(Instruktur::class, 'instruktur_id', 'id');
}

public function jadwalUmum()
    {
        return $this->belongsTo(JadwalUmum::class, 'jadwal_umum_id', 'id');
    }

    use HasFactory;

    protected $fillable = [
        // 'id', 
        'keterangan', 
        'tanggal',
        'jadwal_umum_id',
        'konfirmasi',     
     ];
    //  public function getCreatedAtAttribute()
    //  {
    //      return Carbon::parse($this->attributes['tanggal_lahir'])
    //      ->translatedFormat('l, d F Y');
    //  }
}
