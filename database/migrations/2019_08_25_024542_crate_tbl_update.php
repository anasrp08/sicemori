<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateTblUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_update', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('idLampiran');
            $table->string('order');
            $table->string('pecahan');
            $table->string('noseri');
            $table->string('lini');
            $table->string('keterangan');
            $table->string('created_by')->nullable();
            $table->string('changed_by')->nullable();
            $table->string('deletion')->nullable();
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
        //
        Schema::dropIfExists('tbl_update');
    }
}
