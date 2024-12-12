<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Dosen;
use App\Models\Periode;
use App\Models\Mahasiswa;
use App\Models\Kompetensi;
use App\Models\Performance;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'User1',
        //     'username' => 'user1',
        //     'email' => 'user1@example.com',
        //     'password' => bcrypt('password')
        // ]);
        User::factory()->create([
            'name' => 'Super Admin',
            'username' => 'super',
            'role' => 'superadmin',
            'email' => 'super@admin.com',
            'password' => bcrypt('password')
        ]);
        Kompetensi::create([
            'id' => 1,
            'kompetensi_id' => 'k1',
            'kompetensi' => 'Komunikasi, Edukasi, dan Konseling',
            'label' => 'Skor Komunikasi',
            'slug_kompetensi' => 'skor_s_komunikasi',
            'slug_bobot' => 'bobot_komunikasi'
        ]);
        Kompetensi::create([
            'id' => 2,
            'kompetensi_id' => 'k2',
            'kompetensi' => 'Pengkajian',
            'label' => 'Skor Pengkajian',
            'slug_kompetensi' => 'skor_s_pengkajian',
            'slug_bobot' => 'bobot_pengkajian'
        ]);
        Kompetensi::create([
            'id' => 3,
            'kompetensi_id' => 'k3',
            'kompetensi' => 'Diagnosa dan Perencanaan',
            'label' => 'Skor Diagnosa',
            'slug_kompetensi' => 'skor_s_diagnosa',
            'slug_bobot' => 'bobot_diagnosa'
        ]);
        Kompetensi::create([
            'id' => 4,
            'kompetensi_id' => 'k4',
            'kompetensi' => 'Implementasi',
            'label' => 'Skor Implementasi',
            'slug_kompetensi' => 'skor_s_implementasi',
            'slug_bobot' => 'bobot_implementasi',
        ]);
        Kompetensi::create([
            'id' => 5,
            'kompetensi_id' => 'k5',
            'kompetensi' => 'Evaluasi',
            'label' => 'Skor Evaluasi',
            'slug_kompetensi' => 'skor_s_evaluasi',
            'slug_bobot' => 'bobot_evaluasi',
        ]);
        Kompetensi::create([
            'id' => 6,
            'kompetensi_id' => 'k6',
            'kompetensi' => 'Profesional',
            'label' => 'Skor Profesional',
            'slug_kompetensi' => 'skor_s_profesional',
            'slug_bobot' => 'bobot_profesional',
        ]);

        Performance::create([
            'performance_id' => 1,
            'performance_name' => 'Tidak Lulus',
        ]);
        Performance::create([
            'performance_id' => 2,
            'performance_name' => 'Borderline',
        ]);
        Performance::create([
            'performance_id' => 3,
            'performance_name' => 'Lulus',
        ]);
        Performance::create([
            'performance_id' => 4,
            'performance_name' => 'Superior',
        ]);

        Mahasiswa::factory(50)->create();
        Dosen::factory(10)->create();
        Periode::create([
            'id' => 1,
            'slug_periode' => 'smt_ganjil',
            'periode' => 'Semester Ganjil',
        ]);
        Periode::create([
            'id' => 2,
            'slug_periode' => 'smt_genap',
            'periode' => 'Semester Genap',
        ]);
    }
}
