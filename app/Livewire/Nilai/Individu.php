<?php

namespace App\Livewire\Nilai;

use App\Models\Periode;
use Livewire\Component;
use App\Models\Mahasiswa;
use App\Models\Penilaian;
use Illuminate\Support\Arr;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class Individu extends Component
{
    public $resetBtn = false;

    #[Validate('required', as: 'nama_mhs', message : 'Kolom ini harus diisi!')]
    public $query; //nama_mhs

    #[Validate(['required'])]
    public $nik_mhs = [];

    #[Validate(['required'])]
    public $tahun_penilaian;

    #[Validate(['required'])]
    public $periode;

    public $filtered = [];
    public $highlightIndex;
    public $search = [];
    public $mahasiswa;

    public function render()
    {
        $data_periode = Periode::all();
        $data_tahun = Penilaian::distinct()->orderBy('tahun_penilaian', 'desc')->take(10)->get('tahun_penilaian')->pluck('tahun_penilaian')->toArray();

        if(count($this->filtered) == 0){
            $penilaian = [];
        }else{
            $penilaian = Mahasiswa::with('daftarNilai')
                                    ->where('nik_mhs', $this->filtered['nik_mhs'])
                                    ->whereHas('daftarNilai', function($query) {
                                        $query->where('periode', $this->filtered['periode'])
                                            ->where('tahun_penilaian', $this->filtered['tahun_penilaian']);
                                    })
                                    ->get();
        }
        return view('livewire.nilai.individu', [
            'data_periode' => $data_periode,
            'data_tahun' => $data_tahun,
            'data_penilaian' => $penilaian
        ]);
    }

    public function updatedQuery()
    {
        $this->mahasiswa = Mahasiswa::where('nik_mhs', 'like', '%' . $this->query . '%')
            ->orWhere('nama_mhs', 'like', '%' . $this->query . '%')
            ->get()
            ->take(10);
        $this->search = $this->mahasiswa;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->mahasiswa) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->mahasiswa) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectedMahasiswa($id)
    {
        $data = Mahasiswa::find($id);
        $this->query = $data->nama_mhs;
        $this->nik_mhs = $data->nik_mhs;
        $this->search = [];
    }

    public function filterData()
    {
        $validated = $this->validate();
        $this->filtered = $validated;
        $this->resetBtn = true;
        $this->resetFilter();
    }

    public function resetFilter()
    {
        $this->reset('query', 'periode', 'tahun_penilaian');
        $this->resetBtn = false;
    }
}
