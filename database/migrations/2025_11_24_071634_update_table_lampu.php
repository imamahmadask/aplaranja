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
        Schema::table('lampus', function(Blueprint $table){
            $table->string('lumen', 25)->nullable();
            $table->string('kondisi', 25)->nullable();

            $table->foreignId('tiang_id')->change();
            $table->string('merek', 25)->nullable()->change();
            $table->string('daya', 25)->nullable()->change();

            $table->foreign('tiang_id')
                ->references('id')
                ->on('tiangs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('lampus', function(Blueprint $table){
            $table->dropColumn('lumen');
            $table->dropColumn('kondisi');
        });
    }
};
