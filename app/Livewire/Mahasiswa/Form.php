<?php

namespace App\Livewire\Mahasiswa;

use Livewire\Component;
use App\Models\Mahasiswa;
use Livewire\Attributes\Validate;

class Form extends Component
{

    #[Validate('required', message: 'Nik Mahasiswa harus diisi')]
    #[Validate('unique:mahasiswa', message: 'Nik Mahasiswa sudah terdaftar')]
    #[Validate('numeric', message: 'Nik Mahasiswa harus angka')]
    public $nik_mhs;

    #[Validate('required', message: 'Nama Mahasiswa harus diisi')]
    public $nama_mhs;

    public function render()
    {
        return view('livewire.mahasiswa.form');
    }

    public function addMhsForm()
    {
        $validated = $this->validate();
        $data = Mahasiswa::create($validated);
        $this->reset();
        $this->dispatch('success', ['message' => 'Data Mahasiswa berhasil ditambah..']);
        $this->dispatch('close-modal', 'modalTambah');
        $this->dispatch('refresh');
    }
}
