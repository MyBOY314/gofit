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
        Schema::dropIfExists('izin_instrukturs');

        Schema::create('izin_instrukturs', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->date('tanggal');
            $table->foreignId('jadwal_umum_id')->nullable()->constrained('jadwal_umums');
            $table->boolean('konfirmasi');
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
        Schema::dropIfExists('izin_instrukturs');
    }
};
