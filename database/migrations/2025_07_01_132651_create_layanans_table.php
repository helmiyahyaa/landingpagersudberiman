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
            $table->bigIncrements('id');
            $table->string('judul')->nullable();
            $table->string('subjek1')->nullable();
            $table->text('isi1')->nullable();
            $table->string('subjek2')->nullable();
            $table->text('isi2')->nullable();
            $table->string('subjek3')->nullable();
            $table->text('isi3')->nullable();
            $table->string('subjek4')->nullable();
            $table->string('isi4')->nullable();
            $table->string('subjek5')->nullable();
            $table->string('isi5')->nullable();
            $table->string('subjek6')->nullable();
            $table->string('isi6')->nullable();
            $table->string('foto')->default('https://p4.wallpaperbetter.com/wallpaper/303/255/774/equipment-medicine-laboratory-professionals-wallpaper-preview.jpg');
            $table->string('slug');
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
