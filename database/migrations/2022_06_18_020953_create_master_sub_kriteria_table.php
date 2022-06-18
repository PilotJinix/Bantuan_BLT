<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterSubKriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_sub_kriteria', function (Blueprint $table) {
            $table->id();
            $table->string("kode_unik_kriteria")->references("kode_unik")->on("master_kriteria")->onDelete("cascade")->onUpdate("cascade");
            $table->string("kode_unik")->unique();
            $table->string("nama_sub_kriteria");
            $table->string("kode_sub");
            $table->integer("prioritas_sub");
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
        Schema::dropIfExists('master_sub_kriteria');
    }
}
