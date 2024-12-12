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
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->string('nik_dosen', 100)->unique();
            $table->string('nama_dosen', 200);
            $table->string('nip', 50)->nullable();
            $table->string('gelar_depan', 50)->nullable();
            $table->string('gelar_belakang', 200)->nullable();
            $table->string('jabatan_akademik', 200)->nullable();
            $table->string('pendidikan', 200)->nullable();
            $table->string('perguruan_tinggi', 200)->nullable();
            $table->string('program_studi', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
