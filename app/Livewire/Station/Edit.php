<?php

namespace App\Livewire\Station;

use App\Models\Station;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Edit extends Component
{
    public $id;

    #[validate('required', message: 'Kolom Nomor Station wajib diisi..')]
    #[validate('integer', message: 'Kolom Nomor Station wajib diisi angka..')]
    // #[validate('unique:station', message: 'Nomor Station sudah ada..')]
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

    public function mount($id)
    {
        try {
            $dec_id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return abort(404);
        }
        $this->id = $dec_id;
    }
    public function render()
    {
        $data = Station::where('no_station',$this->id)->first();
        if (!$data) {
            return abort(404);
        }
        $this->no_station = $data->no_station;
        $this->nama_station = $data->nama_station;
        $this->judul = $data->judul;
        $this->waktu = $data->waktu;
        $this->tujuan = $data->tujuan;
        $this->kompetensi = $data->kompetensi;
        $this->kategori = $data->kategori;
        $this->instruksi_penguji = $data->instruksi_penguji;
        $this->instruksi_peserta = $data->instruksi_peserta;

        return view('livewire.station.edit');
    }

    public function simpan()
    {
        $validated = $this->validate();
        Station::find($this->id)->update($validated);
        $this->dispatch('success', ['message' => 'Data Station berhasil diubah..']);
        return $this->redirect('/station/detail/'.Crypt::encryptString($this->id));
    }

    public function kembali()
    {
        return $this->redirect('/station/detail/'.Crypt::encryptString($this->id));
    }
}
