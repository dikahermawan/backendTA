<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('penjual_id')->unsigned();
            $table->foreign('penjual_id')->references('id')->on('user_penjuals');
            $table->string('gambar')->nullable();
            $table->string('nama');
            $table->integer('harga');
            $table->string('satuan');
            $table->integer('stok');
            $table->string('jenis');
            $table->text('deskripsi');
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
        Schema::dropIfExists('produks');
    }
}
