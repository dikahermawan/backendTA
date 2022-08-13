<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTawarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tawars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pembeli_id')->unsigned();
            $table->foreign('pembeli_id')->references('id')->on('user_pembelis');
            $table->bigInteger('lelang_id')->unsigned();
            $table->foreign('lelang_id')->references('id')->on('lelangs');
            $table->string('nama_pembeli');
            $table->text('alamat');
            $table->string('gambar')->nullable();
            $table->integer('harga_tawar');
            $table->string('status_tawar')->nullable();
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
        Schema::dropIfExists('tawars');
    }
}
