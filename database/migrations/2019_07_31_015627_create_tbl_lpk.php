<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblLpk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_lpk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_lampiran_order');
            $table->string('pecahan');
            $table->string('revisi')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('tbl_lpk');
    }
}
