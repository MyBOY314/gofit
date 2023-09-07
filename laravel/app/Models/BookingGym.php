<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gym;
use App\Models\Pegawai;
use App\Models\Member;
use Illuminate\Support\Carbon;

class BookingGym extends Model
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

public function presensiGyms()
{
    return $this->hasMany(PresensiGym::class);
}
    protected $fillable = [
        // 'id', 
        'tanggal',
        'member_id',
        'gym_id', 
        'status',
     ];
    //  public function getCreatedAtAttribute()
    //  {
    //      return Carbon::parse($this->attributes['tanggal_lahir'])
    //      ->translatedFormat('l, d F Y');
    //  }
}
