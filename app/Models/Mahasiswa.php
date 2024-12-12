<?php

namespace App\Models;

use App\Models\Penilaian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'mahasiswa';

    public function daftarNilai() : HasMany
    {
        return $this->hasMany(Penilaian::class, 'nik_mhs', 'nik_mhs');
    }
}
