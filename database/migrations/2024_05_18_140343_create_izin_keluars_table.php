<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinKeluarsTable extends Migration
{
    public function up()
    {
        Schema::create('izin_keluars', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama');
            $table->time('jam_keluar');
            $table->text('keperluan');
            $table->time('jam_masuk')->nullable();
            $table->enum('status', ['Sudah Kembali', 'Belum Kembali'])->default('Belum Kembali');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('izin_keluars');
    }
}