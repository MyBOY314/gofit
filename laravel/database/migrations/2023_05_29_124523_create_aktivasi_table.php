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
        Schema::create('aktivasis', function (Blueprint $table) {
            $table->id();
            $table->date('expired');
            $table->integer('harga');
            $table->foreignId('member_id')->constrained('members');
            $table->foreignId('kasir_id')->constrained('pegawais');
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
        Schema::dropIfExists('aktivasi');
    }
};
