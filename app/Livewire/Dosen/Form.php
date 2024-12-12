<?php

namespace App\Livewire\Dosen;

use App\Models\Dosen;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Form extends Component
{
    #[Validate('required', message: 'Nik Dosen harus diisi')]
    #[Validate('unique:dosen', message: 'Nik Dosen sudah terdaftar')]
    #[Validate('numeric', message: 'Nik Dosen harus angka')]
    public $nik_dosen;

    #[Validate('required', message: 'Nama Dosen harus diisi')]
    public $nama_dosen;

    #[Validate('nullable')]
    public $gelar_depan;

    #[Validate('nullable')]
    public $gelar_belakang;

    #[Validate('nullable')]
    public $jabatan_akademik;

    #[Validate('nullable')]
    public $pendidikan;

    #[Validate('nullable')]
    public $perguruan_tinggi;

    #[Validate('nullable')]
    public $program_studi;


    public function render()
    {
        return view('livewire.dosen.form');
    }

    public function addDosenForm()
    {
        $validated = $this->validate();
        $data = Dosen::create($validated);
        $this->reset();
        $this->dispatch('success', ['message' => 'Data dosen berhasil ditambah..']);
        $this->dispatch('close-modal', 'modalTambah');
        $this->dispatch('refresh');
    }
}
