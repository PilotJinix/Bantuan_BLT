<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkalaSubKriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skala_sub_kriteria', function (Blueprint $table) {
            $table->id();
            $table->string("sub_kriteria_awal")->references("kode_unik")->on("master_sub_kriteria")->onDelete("cascade")->onUpdate("cascade");
            $table->string("sub_kriteria_pembanding")->references("kode_unik")->on("master_sub_kriteria")->onDelete("cascade")->onUpdate("cascade");
            $table->decimal("nilai_skala_sub")->references("id")->on("master_inverse_tfn")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('skala_sub_kriteria');
    }
}
