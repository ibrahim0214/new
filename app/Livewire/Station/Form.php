<?php

namespace App\Livewire\Station;

use App\Models\Station;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Form extends Component
{
    #[validate('required', message: 'Kolom Nomor Station wajib diisi..')]
    #[validate('integer', message: 'Kolom Nomor Station wajib diisi angka..')]
    #[validate('unique:station', message: 'Nomor Station sudah ada..')]
    public $no_station;

    #[validate('required', message: 'Kolom Nama Station wajib diisi..')]
    public $nama_station;

    #[validate('required', message: 'Kolom Judul wajib diisi..')]
    public $judul;

    #[validate('required', message: 'Kolom Judul wajib diisi..')]
    public $waktu;

    #[validate('required', message: 'Kolom Tujuan wajib diisi..')]
    public $tujuan;

    #[validate('required', message: 'Kolom Kompetensi wajib diisi..')]
    public $kompetensi;

    #[validate('required', message: 'Kolom Kategori wajib diisi..')]
    public $kategori;

    #[validate('required', message: 'Kolom Instruksi Penguji wajib diisi..')]
    public $instruksi_penguji;

    #[validate('required', message: 'Kolom Instruksi Peserta wajib diisi..')]
    public $instruksi_peserta;

    public function render()
    {
        return view('livewire.station.form');
    }

    public function simpan()
    {
        $validated = $this->validate();
        Station::create($validated);
        $this->dispatch('success', ['message' => 'Data Station berhasil ditambah..']);
        return redirect()->route('station');
    }

    public function kembali()
    {
        return redirect()->route('station');
    }

    public function mount()
    {
        //cek nomor terakhir
        $lastNum = Station::orderByDesc('id')->first()->no_station ?? 0;
        $this->no_station = $lastNum + 1;
        if($this->no_station < 10) {
            $this->nama_station = 'STATION 0' . $this->no_station;
        }else{
            $this->nama_station = 'STATION ' . $this->no_station;
        }
    }
}
