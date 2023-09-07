<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\Instruktur;
use App\Models\JadwalUmum;
use Illuminate\Support\Carbon;

class PresensiGym extends Model
{
    use HasFactory;

    public function gym()
{
        return $this->belongsTo(Gym::class, 'gym_id', 'id');
}
    
    public function pegawai()
{
        return $this->belongsTo(Pegawai::class, 'kasir_id', 'id');
}
public function member()
{
    return $this->belongsTo(Member::class, 'member_id', 'id');
}
public function bookingGym()
{
    return $this->belongsTo(BookingGym::class, 'booking_gym_id', 'id');
}

    protected $fillable = [
        // 'id', 
        'booking_gym_id',
        'instruktur_id',
        'status',
     ];
    //  public function getCreatedAtAttribute()
    //  {
    //      return Carbon::parse($this->attributes['tanggal_lahir'])
    //      ->translatedFormat('l, d F Y');
    //  }
}
