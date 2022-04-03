<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('kriteria', function (Blueprint $table) {
//            $table->id();
//            $table->string("kode_unik")->unique();
//            $table->enum("type_kriteria", ["KE", "TK", "PPK", "U", "KKK"]);
//            $table->string("keterangan");
//            $table->integer("bobot");
//            $table->timestamps();
//        });

        // Detail
//        Schema::create('kriteria', function (Blueprint $table) {
//            $table->id();
//            $table->string("kode_unik")->references("kode_unik")->on("data_periode")->onDelete("cascade")->onUpdate("cascade");
//            $table->enum("type_kriteria", ["KE", "TK", "PPK", "U", "KKK"]);
//            $table->string("keterangan");
//            $table->integer("bobot");
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
//        Schema::dropIfExists('kriteria');
    }
}
