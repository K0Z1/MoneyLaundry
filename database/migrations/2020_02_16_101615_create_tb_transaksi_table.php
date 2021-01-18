<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('id_outlet')->unsigned();
            $table->string('kode_invoice', 100);
            $table->integer('id_member')->unsigned();
            $table->datetime('tgl');
            $table->datetime('batas_waktu');
            $table->datetime('tgl_bayar');
            $table->integer('biaya_tambahan')->nullable();
            $table->double('diskon')->nullable();
            $table->integer('pajak')->nullable();
            $table->enum('status', ['baru','proses','selesai','diambil']);
            $table->enum('dibayar', ['dibayar','belum_dibayar']);
            $table->integer('id_user')->unsigned();
            // $table->timestamps();

            // Relasi
            $table->foreign('id_outlet')->references('id')->on('tb_outlet')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_member')->references('id')->on('tb_member')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_transaksi');
    }
}
