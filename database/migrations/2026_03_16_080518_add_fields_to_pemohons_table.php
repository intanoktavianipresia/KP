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
    Schema::table('pemohons', function (Blueprint $table) {
        $table->string('telepon')->after('jenis_kelamin');
        $table->string('email')->after('telepon');
        $table->text('arsip')->after('email');
        $table->string('tujuan')->after('arsip');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemohons', function (Blueprint $table) {
            //
        });
    }
};
