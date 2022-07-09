<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_jawaban', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan')->references("kode_unik")->on("status_pengajuan")->onDelete("cascade")->onUpdate("cascade");
            $table->string('kode_kriteria')->references("kode_unik")->on("master_kriteria")->onDelete("cascade")->onUpdate("cascade");
            $table->string('jawaban');
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
        Schema::dropIfExists('hasil_jawaban');
    }
}
