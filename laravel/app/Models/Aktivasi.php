<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;
use App\Models\Pegawai;
use Illuminate\Support\Carbon;

class Aktivasi extends Model
{
    use HasFactory;

    protected $table = 'aktivasis';
    
    public function member()
{
    return $this->belongsTo(Member::class, 'member_id', 'id');
}

public function pegawai()
{
    return $this->belongsTo(Pegawai::class, 'kasir_id', 'id');
}
    protected $fillable = [
        // 'id', 
        'expired',
        'bayar', 
        'member_id',
        'kasir_id',
     ];
    //  public function getCreatedAtAttribute()
    //  {
    //      return Carbon::parse($this->attributes['tanggal_lahir'])
    //      ->translatedFormat('l, d F Y');
    //  }
}
