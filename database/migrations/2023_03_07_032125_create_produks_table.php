<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('kode_produk',12);
            $table->string('nama_produk',20);
            $table->string('kode_kategori');
            $table->string('kode_satuan');
            $table->integer('harga_beli'); 
            $table->tinyInteger('diskon');
            $table->integer('harga_jual');
            $table->string('barcode'); 
            $table->integer('stok')->default(0);  
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
};
