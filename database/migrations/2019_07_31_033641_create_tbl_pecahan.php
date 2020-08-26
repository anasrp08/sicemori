<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPecahan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pecahan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_pecahan');
            $table->string('nama_pecahan');
            $table->string('max_kemas');
            $table->string('color');
            $table->string('keterangan_pecahan');
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
        Schema::dropIfExists('tbl_pecahan');
    }
}
