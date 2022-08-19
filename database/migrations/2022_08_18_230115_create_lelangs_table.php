<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLelangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lelangs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('penjual_id')->unsigned();
            $table->foreign('penjual_id')->references('id')->on('user_penjuals');
            $table->string('gambar')->nullable();
            $table->string('nama');
            $table->string('harga');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->string('jenis');
            $table->text('deskripsi');
            $table->string('status');
            // $table->datetime('waktu');
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
        Schema::dropIfExists('lelangs');
    }
}
