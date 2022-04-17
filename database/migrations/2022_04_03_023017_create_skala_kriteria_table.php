<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkalaKriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skala_kriteria', function (Blueprint $table) {
            $table->id();
            $table->string("kriteria_awal")->references("kode_unik")->on("master_kriteria")->onDelete("cascade")->onUpdate("cascade");
            $table->string("kriteria_pembanding")->references("kode_unik")->on("master_kriteria")->onDelete("cascade")->onUpdate("cascade");
            $table->decimal("nilai_skala")->references("id")->on("master_inverse_tfn")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('skala_kriteria');
    }
}
