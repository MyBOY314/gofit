<?php

namespace Database\Seeders;

use DateTimeZone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use laravel\app\Models\Kelas; 

class JadwalHarianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //KELAS
        DB::table('jadwal_harians')->insert([
            'tanggal' => '2023-05-22',
            'jadwal_umum' => '4',
            'status' => 'Masuk',
        ]);

        DB::table('jadwal_harians')->insert([
            'tanggal' => '2023-05-23',
            'jadwal_umum' => '5',
            'status' => 'Masuk',
        ]);

        DB::table('jadwal_harians')->insert([
            'tanggal' => '2023-05-24',
            'jadwal_umum' => '7',
            'status' => 'Masuk',
        ]);

        DB::table('jadwal_harians')->insert([
            'tanggal' => '2023-05-24',
            'jadwal_umum' => '9',
            'status' => 'Masuk',
        ]);

        DB::table('jadwal_harians')->insert([
            'tanggal' => '2023-05-25',
            'jadwal_umum' => '10',
            'status' => 'Masuk',
        ]);

        DB::table('jadwal_harians')->insert([
            'tanggal' => '2023-05-26',
            'jadwal_umum' => '11',
            'status' => 'Masuk',
        ]);

        DB::table('jadwal_harians')->insert([
            'tanggal' => '2023-05-27',
            'jadwal_umum' => '12',
            'status' => 'Masuk',
        ]);

        DB::table('jadwal_harians')->insert([
            'tanggal' => '2023-05-27',
            'jadwal_umum' => '13',
            'status' => 'Masuk',
        ]);
        
    }
}
