<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusPengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_unik_periode')->references("kode_unik")->on("data_periode")->onDelete("cascade")->onUpdate("cascade");
            $table->string('kode_penerima')->references("nik")->on("datapenerima")->onDelete("cascade")->onUpdate("cascade");
            $table->string('kode_unik')->unique();
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
        Schema::dropIfExists('status_pengajuan');
    }
}
