<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

class MahasiswaImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        return new Mahasiswa([
            'nik_mhs' => $row['nik'],
            'nama_mhs' => $row['nama'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nik' => 'unique:mahasiswa,nik_mhs',
        ];
    }
}
