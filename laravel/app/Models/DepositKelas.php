<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\Member;
use App\Models\Pegawai;
use Illuminate\Support\Carbon;

class DepositKelas extends Model
{
    use HasFactory;

    protected $table = 'deposit_kelas';

    public function member()
{
    return $this->belongsTo(Member::class, 'member_id', 'id');
}

public function pegawai()
{
    return $this->belongsTo(Pegawai::class, 'kasir_id', 'id');
}

public function kelas()
{
    return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
}
    protected $fillable = [
        // 'id', 
        'jumlah_deposit',
        'expired_date', 
        'kelas_id',
        'kasir_id',
        'member_id',
     ];
    //  public function getCreatedAtAttribute()
    //  {
    //      return Carbon::parse($this->attributes['tanggal_lahir'])
    //      ->translatedFormat('l, d F Y');
    //  }
}
