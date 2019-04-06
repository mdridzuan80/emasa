<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJustifikasiKehadiransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('justifikasi_kehadirans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('anggota_id');
            $table->dateTime('justifikasi_tarikh');
            $table->string('justifikasi_jenis');
            $table->string('justifikasi_keterangan');
            $table->string('justifikasi_verifikasi_oleh');
            $table->dateTime('justifikasi_verifikasi_tarikh');
            $table->string('justifikasi_verifikasi_status')->default('M');
            $table->string('justifikasi_planner')->default('N');
            $table->timestamps();

            //For indexing
            $table->index('anggota_id');
            $table->index('justifikasi_tarikh');
            $table->index('justifikasi_jenis');
            $table->index('justifikasi_planner');

            //For defining
            $table->unique(['anggota_id', 'justifikasi_jenis', 'justifikasi_tarikh'],'unik');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('justifikasi_kehadirans');
    }
}
