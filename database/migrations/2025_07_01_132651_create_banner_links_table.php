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
        Schema::create('banner_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->string('foto')->nullable();
            $table->string('link')->nullable();
            $table->enum('status', ['aktif', 'tidak-aktif'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_links');
    }
};
