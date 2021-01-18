<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPaketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_paket', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('id_outlet')->unsigned();
            $table->enum('jenis', ['kiloan','selimut','bad_cover','kaos','lain']);
            $table->string('nama_paket', 100);
            $table->integer('harga');
            $table->timestamps();

            // Relasi
            $table->foreign('id_outlet')->references('id')->on('tb_outlet')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_paket');
    }
}
