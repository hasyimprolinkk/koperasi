<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAngsuranPinjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angsuran_pinjaman', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pinjaman_id')->unsigned();
            $table->bigInteger('nominal');
            $table->integer('angsuran');
            $table->date('jatuh_tempo')->nullable();
            $table->bigInteger('denda')->nullable();
            $table->enum('status', ['belum bayar', 'sudah bayar']);
            $table->timestamps();

            $table->foreign('pinjaman_id')->references('id')->on('pinjaman')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angsuran_pinjaman');
    }
}
