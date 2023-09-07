<?php

namespace Database\Seeders;

use DateTimeZone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use laravel\app\Models\Kelas; 

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //KELAS
        DB::table('kelas')->insert([
            'nama' => 'Yoga',
            'tariff' => '100000',
        ]);
        DB::table('kelas')->insert([
            'nama' => 'Taekwondo',
            'tariff' => '100000',
        ]);
        DB::table('kelas')->insert([
            'nama' => 'DragonFist',
            'tariff' => '170000',
        ]);
        DB::table('kelas')->insert([
            'nama' => 'Senam',
            'tariff' => '15000',
        ]);
        DB::table('kelas')->insert([
            'nama' => 'Ultra Instinct',
            'tariff' => '900000',
        ]);
        DB::table('kelas')->insert([
            'nama' => 'Ultra Instinct',
            'tariff' => '500000',
        ]);
        DB::table('kelas')->insert([
            'nama' => 'Boxing',
            'tariff' => '120000',
        ]);
        DB::table('kelas')->insert([
            'nama' => 'Nen',
            'tariff' => '220000',
        ]);
        DB::table('kelas')->insert([
            'nama' => 'Cardio',
            'tariff' => '130000',
        ]);

        //
        
    }
}
