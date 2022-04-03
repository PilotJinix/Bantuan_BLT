<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubKriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_kriteria', function (Blueprint $table) {
            $table->id();
            $table->string("kode_unik_kriteria")->references("kode_unik")->on("master_kriteria")->onDelete("cascade")->onUpdate("cascade");
            $table->string("keterangan");
            $table->integer("bobot");
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
        Schema::dropIfExists('sub_kriteria');
    }
}
