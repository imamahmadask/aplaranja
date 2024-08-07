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
        Schema::create('tiangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 15);
            $table->string('kategori');
            $table->string('jenis');
            $table->string('lengan');
            $table->string('tahun');
            $table->string('bahan');
            $table->integer('panel_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiangs');
    }
};
