<?php

namespace App\Livewire\Station\Detail;

use Livewire\Component;
use App\Models\Kriteria;
use App\Models\Kompetensi;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class EditKriteria extends Component
{
    public $id;
    public $station_id;

    #[Validate('required', message: 'Kolom Kompetensi harus diisi..')]
    public $kompetensi_id;
    public $kompetensi;

    #[Validate('required', message: 'Kolom Skor harus diisi..')]
    public $skor_0;

    #[Validate('required', message: 'Kolom Skor harus diisi..')]
    public $skor_1;

    #[Validate('required', message: 'Kolom Skor harus diisi..')]
    public $skor_2;

    #[Validate('required', message: 'Kolom Skor harus diisi..')]
    public $skor_3;

    #[Validate('required', message: 'Kolom Bobot harus diisi..')]
    #[Validate('numeric', message: 'Kolom Bobot harus berisi angka..')]
    public $bobot;

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
        $data = Kriteria::find($this->id);
        $this->kompetensi_id = $data->kompetensi_id;
        $this->station_id = $data->station_id;
        $this->skor_0 = $data->skor_0;
        $this->skor_1 = $data->skor_1;
        $this->skor_2 = $data->skor_2;
        $this->skor_3 = $data->skor_3;
        $this->bobot = $data->bobot;

        $data_kompetensi = Kompetensi::get()->toArray();
        return view('livewire.station.detail.edit-kriteria', ['data_kompetensi' => $data_kompetensi]);
    }

    public function formKriteria()
    {
        $validated = $this->validate();

        //ambil data kompetensi apabila diubah
        $kompetensi = Kompetensi::where('kompetensi_id', $this->kompetensi_id)->first();
        $validated['kompetensi'] = $kompetensi->kompetensi;

        //update ke database
        Kriteria::find($this->id)->update($validated);
        $this->dispatch('success', ['message' => 'Data Kriteria Station berhasil diubah..']);
        return redirect()->route('detail-station', Crypt::encryptString($this->station_id));
    }

    public function kembali()
    {
        return redirect()->route('detail-station', Crypt::encryptString($this->station_id));
    }
}
