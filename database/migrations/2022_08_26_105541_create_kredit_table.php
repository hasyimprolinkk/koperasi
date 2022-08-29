<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kredit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anggota_id')->unsigned();
            $table->string('nama_barang');
            $table->bigInteger('nominal');
            $table->string('bunga')->default('3%');
            $table->integer('tenor');
            $table->bigInteger('angsuran');
            $table->bigInteger('total_bayar');
            $table->string('keterangan')->nullable();
            $table->enum('status', ['belum lunas', 'lunas']);
            $table->timestamps();

            //id, anggota_id, nama_barang, nominal, bunga, tenor, hasil_bagi, total, keterangan, status

            $table->foreign('anggota_id')->references('id')->on('anggota')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kredit');
    }
}
