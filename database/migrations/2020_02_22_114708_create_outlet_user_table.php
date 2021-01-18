<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutletUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlet_user', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('id_outlet')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->timestamps();

            // Relasi
            $table->foreign('id_outlet')->references('id')->on('tb_outlet')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('outlet_user');
    }
}
