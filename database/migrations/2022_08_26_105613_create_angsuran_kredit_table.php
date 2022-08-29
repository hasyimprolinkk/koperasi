<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAngsuranKreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angsuran_kredit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kredit_id')->unsigned();
            $table->bigInteger('nominal');
            $table->integer('angsuran');
            $table->date('jatuh_tempo')->nullable();
            $table->bigInteger('denda')->nullable();
            $table->enum('status', ['belum bayar', 'sudah bayar']);
            $table->timestamps();

            $table->foreign('kredit_id')->references('id')->on('kredit')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angsuran_kredit');
    }
}
