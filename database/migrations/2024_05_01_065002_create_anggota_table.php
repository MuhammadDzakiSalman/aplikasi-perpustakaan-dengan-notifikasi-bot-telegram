<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id('id_anggota');
            $table->string('nama_anggota');
            $table->string('jabatan');
            $table->string('kelas')->nullable()->default(null);
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->string('nisn_nip')->unique();
            $table->string('chat_id')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
