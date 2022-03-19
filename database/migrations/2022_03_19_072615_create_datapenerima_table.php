<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatapenerimaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datapenerima', function (Blueprint $table) {
            $table->id();
            $table->string("nik",16)->unique();
            $table->string("nama");
            $table->string("alamat");
            $table->timestamps();
            //buat tabel di database
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datapenerima');
    }
}
