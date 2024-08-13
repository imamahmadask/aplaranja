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
        Schema::create('riwayat_tiangs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('jenis');
            $table->string('kerusakan');
            $table->string('perbaikan');
            $table->string('keterangan');
            $table->integer('tiang_id');
            $table->integer('regu_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_tiangs');
    }
};
