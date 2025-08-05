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
        Schema::create('permintaan_ppids', function (Blueprint $table) {
            $table->integer('id', true);
            $table->enum('jenis_pemohon', ['perorang', 'kelompok_orang', 'badan_hukum'])->nullable();
            $table->enum('jenis_identitas_pmhn', ['ktp', 'anggaran_dasar', 'surat_kuasa'])->nullable();
            $table->string('no_identitas_pmhn')->nullable();
            $table->string('nm_lengkap_pmhn', 45)->nullable();
            $table->string('email_pmhn')->nullable();
            $table->string('no_telp_pmhn', 45)->nullable();
            $table->string('info_dibutuhkan')->nullable();
            $table->string('alasan_permintaan')->nullable();
            $table->string('nm_lengkap_pggn')->nullable();
            $table->string('no_ktp_pggn')->nullable();
            $table->text('alamat_pggn')->nullable();
            $table->string('no_telp_pggn')->nullable();
            $table->string('email_pggn')->nullable();
            $table->string('alasan_pggn')->nullable();
            $table->enum('jenis_pmhn', ['langsung', 'email', 'website', 'fax'])->nullable();
            $table->string('status')->nullable()->default('Belum Dikonfirmasi');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_ppids');
    }
};
