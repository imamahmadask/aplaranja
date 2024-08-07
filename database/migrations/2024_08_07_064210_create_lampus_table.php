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
        Schema::create('lampus', function (Blueprint $table) {
            $table->id();
            $table->string('jenis', 15);
            $table->string('daya', 15);
            $table->string('merek', 15);
            $table->string('tiang_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lampus');
    }
};
