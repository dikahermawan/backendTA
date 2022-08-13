<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_mobiles', function (Blueprint $table) {
            $table->id();
            $table->string('gambar')->nullable();
            $table->string('kategori');
            $table->string('nama');
            $table->text('alamat');
            $table->string('email');
            $table->string('password');
            $table->string('no_rekening')->nullable();
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
        Schema::dropIfExists('user_mobiles');
    }
}
