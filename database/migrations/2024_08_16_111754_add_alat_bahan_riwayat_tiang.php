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
        Schema::table('riwayat_panels', function(Blueprint $table){
            $table->string('alat')->nullable();
            $table->string('bahan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayat_panels', function(Blueprint $table){
            $table->dropColumn('alat');
            $table->dropColumn('bahan');
        });
    }
};
