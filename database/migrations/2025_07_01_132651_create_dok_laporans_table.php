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
        Schema::create('dok_laporans', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('judul')->nullable();
            $table->text('isi')->nullable();
            $table->string('foto')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('kt_laporans_id')->index('fk_dok_laporans_kt_laporans1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dok_laporans');
    }
};
