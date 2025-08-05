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
        Schema::create('layanans', function (Blueprint $table) {
            $table->id(); // <-- INI YANG PALING PENTING
            $table->string('judul');
            $table->string('subjek1')->nullable();
            $table->text('isi1')->nullable();
            $table->string('subjek2')->nullable();
            $table->text('isi2')->nullable();
            $table->string('subjek3')->nullable();
            $table->text('isi3')->nullable();
            $table->string('foto')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
