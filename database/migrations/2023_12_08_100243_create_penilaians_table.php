<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_kriteria');
            $table->string('nama_kriteria');
            $table->date('waktu_penilaian');
            $table->string('nip');
            $table->string('nama_pegawai');
            $table->string('nama_penilai');
            $table->string('skor');
            $table->string('bobot');
            $table->float('skor_nilai');
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
        Schema::dropIfExists('penilaians');
    }
}
