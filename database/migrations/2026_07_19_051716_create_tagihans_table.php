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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->integer('panel_id')->nullable()->index();
            $table->string('idpel', 50)->index();
            $table->string('nama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('tarif', 20)->nullable();
            $table->integer('daya')->nullable();
            $table->string('blth', 10)->index();
            $table->unsignedTinyInteger('bulan')->index();
            $table->unsignedSmallInteger('tahun')->index();
            $table->integer('pemkwh')->default(0);
            $table->decimal('rptag', 15, 2)->default(0);
            $table->decimal('materai', 15, 2)->default(0);
            $table->decimal('admin', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->timestamps();

            $table->unique(['idpel', 'blth']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
