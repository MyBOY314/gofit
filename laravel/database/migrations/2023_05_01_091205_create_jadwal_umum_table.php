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
Schema::dropIfExists('jadwal_umums');

Schema::create('jadwal_umums', function (Blueprint $table) {
$table->id();
$table->string('hari');
$table->foreignId('kelas_id')->constrained('kelas');
$table->foreignId('instruktur_id')->constrained('instrukturs');
$table->time('jam');
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
        Schema::dropIfExists('jadwal_umums');
    }
};
