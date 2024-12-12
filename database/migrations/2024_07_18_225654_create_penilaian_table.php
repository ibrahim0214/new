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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_penilaian');
            $table->string('periode');
            $table->string('jenis_penilaian');
            $table->string('perbaikan_ke')->nullable();
            $table->string('tgl_penilaian');
            $table->integer('no_station');
            $table->string('nama_station');
            $table->string('judul');
            $table->string('nik_mhs');
            $table->string('nama_mhs');
            $table->string('nama_dosen');
            $table->string('gelar_belakang')->nullable();
            $table->integer('skor_s_pengkajian')->nullable();
            $table->integer('skor_s_komunikasi')->nullable();
            $table->integer('skor_s_diagnosa')->nullable();
            $table->integer('skor_s_implementasi')->nullable();
            $table->integer('skor_s_evaluasi')->nullable();
            $table->integer('skor_s_profesional')->nullable();
            $table->integer('nilai_akhir')->nullable();
            $table->string('performance_id')->nullable();
            $table->string('performance_name')->nullable();
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
