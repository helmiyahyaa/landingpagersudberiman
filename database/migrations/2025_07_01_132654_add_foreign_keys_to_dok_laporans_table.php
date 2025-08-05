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
        Schema::table('dok_laporans', function (Blueprint $table) {
            $table->foreign(['kt_laporans_id'], 'fk_dok_laporans_kt_laporans1')->references(['id'])->on('kt_laporans')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dok_laporans', function (Blueprint $table) {
            $table->dropForeign('fk_dok_laporans_kt_laporans1');
        });
    }
};
