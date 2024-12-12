<?php

namespace App\Livewire\Mahasiswa;

use Livewire\Component;
use App\Models\Mahasiswa;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;
use Livewire\WithoutUrlPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use withFileUploads;

    use WithPagination, WithoutUrlPagination;

    public $perPage = 10;
    public $search = '';
    public $id_mhs;

    // #[Validate('nullable', message : 'Kolom file tidak boleh kosong')]
    public $file_mhs;

    #[Validate('required', message : 'NIK tidak boleh kosong')]
    #[Validate('numeric', message : 'NIK harus berupa angka')]
    public $nik_mhs;

    #[Validate('required', message : 'Nama mahasiswa tidak boleh kosong')]
    public $nama_mhs;

    #[On('refresh')]
    public function render()
    {
        $data = Mahasiswa::where('nik_mhs', 'like', '%'.$this->search.'%')
                            ->orWhere('nama_mhs', 'like', '%'.$this->search.'%')
                            ->orderBy('id', 'desc')
                            ->paginate($this->perPage);

        return view('livewire.mahasiswa.index', ['data_mhs' => $data]);
    }

    public function edit(Mahasiswa $mhs)
    {
        $this->nik_mhs = $mhs->nik_mhs;
        $this->nama_mhs = $mhs->nama_mhs;
        $this->id_mhs = $mhs->id;
        $this->dispatch('open-modal', 'modalEdit');
    }

    public function simpan()
    {
        $validated = $this->validate();
        Mahasiswa::find($this->id_mhs)->update($validated);
        $this->dispatch('close-modal', 'modalEdit');
        $this->dispatch('success', ['message' => 'Data mahasiswa berhasil diubah..']);
        $this->dispatch('refresh');
    }

    public function tambah()
    {
        $this->dispatch('open-modal', 'modalTambah');
    }

    public function import()
    {
        $this->dispatch('open-modal', 'modalImport');
    }

    public function importMhs()
    {
        $validated = $this->validate([
            'file_mhs' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        try {
            Excel::import(new MahasiswaImport, $validated['file_mhs']);
            $this->dispatch('close-modal', 'modalImport');
            $this->dispatch('success', ['message' => 'Data mahasiswa berhasil diimport..']);
            $this->dispatch('refresh');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             $failures = $e->failures();
             foreach ($failures as $failure) {
                 $this->dispatch('close-modal', 'modalImport');
                 $this->dispatch('error', ['message' => 'Terdapat duplikasi NIK mahasiswa pada baris ke-'.$failure->row()]);
                 $this->dispatch('refresh');
             }
        }

    }

    public function downloadTemplate()
    {
        return Storage::disk('public_folder')->download('file_template/import-mahasiswa.xlsx');
    }
}
