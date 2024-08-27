<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanTable extends Migration
{
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id_peminjaman');
            $table->unsignedBigInteger('id_buku');
            $table->unsignedBigInteger('id_anggota');
            $table->date('tgl_peminjaman');
            $table->date('tgl_pengembalian');
            $table->boolean('status_peminjaman')->default(false);
            $table->text('riwayat_chat')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_anggota')->references('id_anggota')->on('anggota')->onDelete('cascade');
            $table->foreign('id_buku')->references('id_buku')->on('buku')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}

