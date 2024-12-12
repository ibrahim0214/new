<?php

namespace App\Livewire\Station;

use App\Models\Station;
use Livewire\Component;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Crypt;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $perPage = 10;
    public $search = '';
    public Station $stationSelected;

    #[On('refresh')]
    public function render()
    {
        $data = Station::where('nama_station', 'like', '%'.$this->search.'%')
                            ->orWhere('judul', 'like', '%'.$this->search.'%')
                            ->orderBy('id', 'desc')
                            ->paginate($this->perPage);

        return view('livewire.station.index', ['stations' => $data]);
    }

    public function tambah()
    {
        return $this->redirect('/station/tambah', navigate: true);
    }

    public function edit($id)
    {
        $enc_id = Crypt::encryptString($id);
        return $this->redirect('/station/edit/'.$enc_id, navigate: true);
    }

    public function detail($id)
    {
        $enc_id = Crypt::encryptString($id);
        return $this->redirect('/station/detail/'.$enc_id, navigate: true);
    }

    public function mauDihapus(Station $station)
    {
        $this->stationSelected = $station;
        //cek apakah ada data nilai di tabel penilaian
        if (Penilaian::where('no_station', $this->stationSelected->id)->count() > 0) {
            $this->dispatch('open-modal', 'modalGagalHapus');
        }else{
            $this->dispatch('open-modal', 'modalHapus');
        }
    }

    public function hapusData()
    {
        //hapus data di tabel station
        $this->stationSelected->delete();

        //hapus data di tabel kriteria
        Kriteria::where('station_id', $this->stationSelected->id)->delete();

        $this->dispatch('success', ['message' => 'Data '.$this->stationSelected->nama_station.' berhasil dihapus']);
        $this->dispatch('close-modal', 'modalHapus');
        $this->dispatch('refresh');
    }
}
