<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterInverseTfnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_inverse_tfn', function (Blueprint $table) {
            $table->id();
            $table->string("kode_unik")->unique();
            $table->double("l_tfn");
            $table->double("f_tfn");
            $table->double("n_tfn");
            $table->double("l_reciprocal");
            $table->double("f_reciprocal");
            $table->double("n_reciprocal");
            $table->string("keterangan");
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
        Schema::dropIfExists('master_inverse_tfn');
    }
}
