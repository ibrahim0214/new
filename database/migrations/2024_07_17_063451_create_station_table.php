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
        Schema::create('station', function (Blueprint $table) {
            $table->id();
            $table->integer('no_station')->unique();
            $table->string('nama_station', 100);
            $table->string('judul', 200);
            $table->string('waktu', 100);
            $table->string('tujuan', 500);
            $table->string('kompetensi', 2000);
            $table->string('kategori', 2000);
            $table->string('instruksi_penguji', 2000);
            $table->string('instruksi_peserta', 2000);
            $table->string('status',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('station');
    }
};