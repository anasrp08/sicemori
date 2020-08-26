<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pesanan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('jumlah_pesanan',15,0);
            $table->string('seri_terakhir');
            $table->string('nomor_terakhir');
            $table->string('order_terakhir');
            $table->string('pecahan');
            $table->string('tahun');
            $table->string('tahun_emisi');
            $table->string('insit_persen');
            $table->decimal('jumlah_insit',15,0);
            $table->decimal('lembar_insit',15,0);
            $table->integer('order_tnpinsit');
            $table->integer('order_insit');
            $table->integer('total_order');
            $table->decimal('total_pesanan',15,0);
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
        Schema::dropIfExists('tbl_pesanan');
    }
}
