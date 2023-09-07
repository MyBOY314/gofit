<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi_kelas', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->foreignId('member_id')->nullable()->constrained('members');
            $table->foreignId('kasir_id')->nullable()->constrained('pegawais');
            $table->foreignId('jadwal_harian')->constrained('jadwal_harians');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presensi_kelas');
    }
};
