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
//        Schema::create('data_periode', function (Blueprint $table) {
//            $table->id();
//            $table->string("kode_unik")->unique();
//            $table->string("nama");
//            $table->string("kuota");
//            $table->string("status")->default("0");
//            $table->timestamps();
//        });
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
