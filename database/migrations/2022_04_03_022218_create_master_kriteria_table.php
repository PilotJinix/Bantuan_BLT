<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_kriteria', function (Blueprint $table) {
            $table->id();
            $table->string("kode_unik_skala")->references("kode_unik")->on("master_skala")->onDelete("cascade")->onUpdate("cascade");
            $table->string("kode_unik")->unique();
            $table->string("nama_kriteria");
            $table->string("kode");
            $table->integer("prioritas");
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
        Schema::dropIfExists('master_kriteria');
    }
}
