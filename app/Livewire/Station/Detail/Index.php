<?php

namespace App\Livewire\Station\Detail;

use App\Models\Station;
use Livewire\Component;
use App\Models\Kriteria;
use Illuminate\Support\Facades\Crypt;

class Index extends Component
{
    public $id;
    public Kriteria $kriteriaSelected;

    public function mount($id)
    {
        try {
            $dec_id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return abort(404);
        }
        $this->id = $dec_id;
    }

    #[On('refreshKriteria')]
    public function render()
    {
        $data_station = Station::where('no_station',$this->id)->first();
        if (!$data_station) {
            return abort(404);
        }
        //ambil data kriteria
        $data_kriteria = Kriteria::where('station_id', $this->id)->paginate(10);

        return view('livewire.station.detail.index', ['data_station' => $data_station, 'data_kriteria' => $data_kriteria]);
    }

    public function edit($id)
    {
        $enc_id = Crypt::encryptString($id);
        return $this->redirect('/station/edit/'.$enc_id, navigate: true);
    }

    public function tambahKriteria()
    {
        //$this->dispatch('open-modal', 'modalKriteria');
        $enc_id = Crypt::encryptString($this->id);
        $this->redirect('/station/tambah-kriteria/'.$enc_id, navigate: true);
    }

    public function mauDihapus(Kriteria $kriteria)
    {
        $this->kriteriaSelected = $kriteria;
        $this->dispatch('open-modal', 'modalHapus');
    }

    public function hapusKriteria()
    {
        $this->kriteriaSelected->delete();
        $this->dispatch('success', ['message' => 'Data kriteria berhasil dihapus..']);
        $this->dispatch('close-modal', 'modalHapus');
        $this->dispatch('refreshKriteria');
    }

    public function editKriteria(Kriteria $kriteria)
    {
        $this->redirect('/station/edit-kriteria/'.Crypt::encryptString($kriteria->id), navigate: true);
    }

    public function kembali()
    {
        $this->redirect('/station');
    }
}
