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
            $table->float("l_tfn");
            $table->float("f_tfn");
            $table->float("n_tfn");
            $table->float("l_reciprocal");
            $table->float("f_reciprocal");
            $table->float("n_reciprocal");
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
