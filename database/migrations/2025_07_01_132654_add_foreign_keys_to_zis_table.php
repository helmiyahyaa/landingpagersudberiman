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
        Schema::table('zis', function (Blueprint $table) {
            $table->foreign(['kt_zis'])->references(['id'])->on('kt_zis')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zis', function (Blueprint $table) {
            $table->dropForeign('zis_kt_zis_foreign');
        });
    }
};
