<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cekout_id')->unsigned();
            $table->foreign('cekout_id')->references('id')->on('cekouts');
            $table->bigInteger('pembeli_id')->unsigned();
            $table->foreign('pembeli_id')->references('id')->on('user_pembelis');
            $table->string('nama_pembeli');
            $table->integer('no_rekening');
            $table->text('alamat');
            $table->string('gambar')->nullable();
            $table->integer('harga');
            $table->integer('ongkir');
            $table->integer('jumlah');
            $table->integer('subtotal');
            $table->integer('total_bayar');
            $table->string('status_pembayaran')->nullable();
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
        Schema::dropIfExists('pembayarans');
    }
}
