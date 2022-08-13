<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCekoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cekouts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pembeli_id')->unsigned();
            $table->foreign('pembeli_id')->references('id')->on('user_pembelis');
            $table->bigInteger('produk_id')->unsigned();
            $table->foreign('produk_id')->references('id')->on('produks');
            $table->string('nama_pembeli');
            $table->string('gambar')->nullable();
            $table->integer('ongkir');
            $table->integer('no_rekening');
            $table->text('alamat');
            $table->integer('harga');
            $table->integer('jumlah');
            $table->integer('subtotal');
            $table->integer('total_bayar');
            $table->text('catatan');
            $table->string('status_pesanan')->nullable();
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
        Schema::dropIfExists('cekouts');
    }
}
