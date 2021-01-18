<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbDetailTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_transaksi', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('id_transaksi')->unsigned();
            $table->integer('id_paket')->unsigned();
            $table->double('qty');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Relasi
            $table->foreign('id_transaksi')->references('id')->on('tb_transaksi')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_paket')->references('id')->on('tb_paket')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_detail_transaksi');
    }
}
