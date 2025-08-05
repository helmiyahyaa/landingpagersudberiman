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
        Schema::create('pollings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pertanyaan')->nullable();
            $table->integer('a')->nullable();
            $table->integer('b')->nullable();
            $table->integer('c')->nullable();
            $table->integer('d')->nullable();
            $table->string('jwbn')->nullable();
            $table->integer('jmlh')->nullable()->default(1);
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pollings');
    }
};
