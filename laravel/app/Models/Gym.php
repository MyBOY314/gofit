<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Gym extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'id', 
        'slot_waktu', 
     ];

}
