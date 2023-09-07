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
        Schema::dropIfExists('deposit_regulers');

        Schema::create('deposit_regulers', function (Blueprint $table) {
            $table->id();
            $table->integer('deposit_uang');
            $table->foreignId('member_id')->nullable()->constrained('members');
            $table->foreignId('kasir_id')->nullable()->constrained('pegawais');
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
        Schema::dropIfExists('deposit_regulers');
    }
};
