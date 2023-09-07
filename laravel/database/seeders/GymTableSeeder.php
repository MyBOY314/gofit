<?php

namespace Database\Seeders;

use DateTimeZone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use laravel\app\Models\Kelas; 

class GymTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //KELAS
        DB::table('gym')->insert([
            'slot_waktu' => '7-9',
        ]);
        DB::table('gym')->insert([
            'slot_waktu' => '9-11',
        ]);
        DB::table('gym')->insert([
            'slot_waktu' => '11-13',
        ]);
        DB::table('gym')->insert([
            'slot_waktu' => '13-15',
        ]);
        DB::table('gym')->insert([
            'slot_waktu' => '15-17',
        ]);
        DB::table('gym')->insert([
            'slot_waktu' => '17-19',
        ]);
        DB::table('gym')->insert([
            'slot_waktu' => '19-21',
        ]);
    }
}
