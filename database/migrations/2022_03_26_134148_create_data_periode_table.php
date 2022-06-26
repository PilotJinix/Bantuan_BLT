<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPeriodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_periode', function (Blueprint $table) {
            $table->id();
            $table->string("kode_unik_skala")->references("kode_unik")->on("master_skala")->onDelete("cascade")->onUpdate("cascade");
            $table->string("kode_unik")->unique();
            $table->string("nama");
            $table->dateTime("periode");
            $table->string("kuota");
            $table->string("status")->default("0");
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
//        Schema::dropIfExists('data_periode');
    }
}
