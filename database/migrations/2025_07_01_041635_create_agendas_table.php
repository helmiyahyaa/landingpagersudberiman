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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id(); // Sesuai dengan `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
            $table->string('judul')->nullable();
            $table->text('isi')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps(); // Membuat kolom created_at dan updated_at
            $table->softDeletes(); // Membuat kolom deleted_at untuk fitur soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};