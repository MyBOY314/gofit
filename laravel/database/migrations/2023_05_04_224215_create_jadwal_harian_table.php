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
Schema::dropIfExists('jadwal_harians');

Schema::create('jadwal_harians', function (Blueprint $table) {
$table->id();
$table->date('tanggal');
$table->foreignId('jadwal_id')->constrained('jadwal_umums');
$table->foreignId('instruktur_id')->nullable()->constrained('instrukturs');
$table->string('status');
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
        Schema::dropIfExists('jadwal_harians');
    }
};
