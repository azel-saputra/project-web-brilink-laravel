<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->string('tujuan');
            $table->string('nominal');
            $table->string('kategori');
            $table->string('metode');
            $table->string('trx')->nulable();
            $table->string('app')->nulable();
            $table->string('total');
            $table->string('admin');
            $table->string('tax')->nulable();
            $table->string('fee')->nulable();
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
        Schema::dropIfExists('transaksi');
    }
}
