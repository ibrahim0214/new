<?php

namespace App\Livewire\Station\Detail;

use Livewire\Component;
use App\Models\Kriteria;
use App\Models\Kompetensi;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Crypt;

class Form extends Component
{
    public $id;

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
        $data = Kompetensi::whereNotIn('kompetensi_id', function($query){
                            $query->select('kompetensi_id')->from('kriteria')->where('station_id', $this->id);
                        })
                        ->get()->toArray();
        return view('livewire.station.detail.form', ['data' => $data]);
    }

    public function formKriteria()
    {
        $validated = $this->validate();
        $kompetensi = Kompetensi::where('kompetensi_id', $this->kompetensi_id)->first();
        $validated['kompetensi'] = $kompetensi->kompetensi;
        $validated['station_id'] = $this->id;
        Kriteria::create($validated);
        $this->dispatch('success', ['message' => 'Data Kriteria Station berhasil ditambah..']);
        return redirect()->route('detail-station', Crypt::encryptString($this->id));
    }

    public function kembali()
    {
        $enc_id = Crypt::encryptString($this->id);
        $this->redirect('/station/detail/' . $enc_id);
    }
}
