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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
    $table->id();

    // DATA PEMOHON
    $table->string('nama');
    $table->text('alamat');
    $table->string('jenis_kelamin');
    $table->string('telepon');
    $table->string('email');

    // DATA PEMINJAMAN
    $table->string('arsip');
    $table->text('tujuan');
    $table->date('tanggal_kunjungan');

    // STATUS ADMIN
    $table->string('status')->default('Menunggu');

    $table->timestamps();
});
    }
};
