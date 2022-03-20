<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailDataPenerimaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_data_penerima', function (Blueprint $table) {
            $table->id();
            $table->string("nik")->references("nik")->on("datapenerima")->onDelete("cascade")->onUpdate("cascade");
            $table->string("sub_ekonomi");
            $table->string("sub_kesejahteraan");
            $table->string("sub_penyakit");
            $table->string("sub_usia");
            $table->string("sub_k_keluarga");
            $table->integer("bobot_ekonomi");
            $table->integer("bobot_kesejahteraan");
            $table->integer("bobot_penyakit");
            $table->integer("bobot_usia");
            $table->integer("bobot_k_keluarga");
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
        Schema::dropIfExists('detail_data_penerima');
    }
}
