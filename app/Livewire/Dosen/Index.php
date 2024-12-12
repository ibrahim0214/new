<?php

namespace App\Livewire\Dosen;

use App\Models\Dosen;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $perPage = 10;
    public $search = '';

    public $id_dosen;

    #[Validate('required', message: 'Nik dosen harus diisi')]
    #[Validate('numeric', message: 'Nik dosen harus angka')]
    public $nik_dosen;

    #[Validate('required', message: 'Nama dosen harus diisi')]
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

    #[On('refresh')]
    public function render()
    {
        $data = Dosen::where('nik_dosen', 'like', '%'.$this->search.'%')
                            ->orWhere('nama_dosen', 'like', '%'.$this->search.'%')
                            ->orderBy('id', 'desc')
                            ->paginate($this->perPage);
        return view('livewire.dosen.index', ['data' => $data]);
    }

    public function edit(Dosen $dosen)
    {
        $this->dispatch('open-modal', 'modalEdit');
        $this->id_dosen = $dosen->id;
        $this->nik_dosen = $dosen->nik_dosen;
        $this->nama_dosen = $dosen->nama_dosen;
        $this->gelar_depan = $dosen->gelar_depan;
        $this->gelar_belakang = $dosen->gelar_belakang;
        $this->jabatan_akademik = $dosen->jabatan_akademik;
        $this->pendidikan = $dosen->pendidikan;
        $this->perguruan_tinggi = $dosen->perguruan_tinggi;
        $this->program_studi = $dosen->program_studi;
    }

    public function update()
    {
        $validated = $this->validate();
        $dosen = Dosen::find($this->id_dosen)->update($validated);
        $this->dispatch('close-modal', 'modalEdit');
        $this->dispatch('success', ['message' => 'Data dosen berhasil diubah']);
        $this->dispatch('refresh');
    }

    public function tambah()
    {
        $this->dispatch('open-modal', 'modalTambah');
    }
}
