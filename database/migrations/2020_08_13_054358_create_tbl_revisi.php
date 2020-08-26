<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblRevisi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_revisi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idlampiran'); 
            $table->string('idpesanan');
            $table->integer('no_lampiran');
            $table->integer('level');
            $table->string('pecahan');
            $table->string('ta');
            $table->string('tahun_emisi');
            $table->integer('nomor_order');
            $table->string('seri');
            $table->string('nomor');
            $table->string('pemasok')->nullable();
            $table->string('no_ba')->nullable();
            $table->date('tanggal')->nullable();
            $table->integer('jmlh_kertas')->nullable();
            $table->string('invoice')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('lini')->nullable();
            $table->integer('revisi')->default(0);
            $table->string('catatan')->default('-');
            $table->string('lot_bi')->nullable();
            $table->integer('status')->default(0);
            $table->string('np');
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
        Schema::dropIfExists('tbl_revisi');
    }
}
