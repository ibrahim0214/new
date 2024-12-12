<?php

namespace App\Livewire\Penilaian;

use App\Models\Station;
use Livewire\Component;
use App\Models\Penilaian;
use App\Models\Performance;
use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use App\Exports\PenilaianExport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Index extends Component
{
    public $perPage = 10;
    public $search = '';
    public $clearFilter = true;
    public $tahun_penilaian = '';
    public $periode = '';
    public $station_id = '';
    public $performance_id = '';

    #[On('refresh')]
    public function render()
    {
        //data tahun penilaian
        $data_tahun = Penilaian::distinct()->orderBy('tahun_penilaian', 'desc')->take(10)->get('tahun_penilaian')->pluck('tahun_penilaian')->toArray();

        //data semua station
        $station = Station::all();

        //data station yang ada pada penilaian
        $station_penilaian = Penilaian::distinct()->get('nama_station')->pluck('nama_station')->toArray();

        //data performance
        $data_performance = Performance::all();

        //data penilaian
        $penilaian = Penilaian::when($this->tahun_penilaian,function($query) {
                                return $query->where('tahun_penilaian',$this->tahun_penilaian);
                            })->when($this->periode,function($query) {
                                return $query->where('periode',$this->periode);
                            })->when($this->station_id,function($query) {
                                return $query->where('no_station',$this->station_id);
                            })->when($this->performance_id,function($query) {
                                return $query->where('performance_id',$this->performance_id);
                            })
                            ->orderBy('no_station', 'asc')
                            ->paginate($this->perPage);

        return view('livewire.penilaian.index', [
                        'data_penilaian' => $penilaian,
                        'data_station' => $station,
                        'data_tahun' => $data_tahun,
                        'data_performance' => $data_performance,
                        'station_penilaian' => $station_penilaian
                    ]);
    }

    public function applyFilter()
    {
        $this->dispatch('refresh');
        $this->clearFilter = false;
    }

    public function resetFilter()
    {
        $this->periode = '';
        $this->station_id = '';
        $this->tahun_penilaian = '';
        $this->performance_id = '';
        $this->clearFilter = true;
        $this->dispatch('refresh');
    }

    public function downloadExcel()
    {
        $filtered = [
            'periode' => $this->periode,
            'tahun_penilaian' => $this->tahun_penilaian,
            'no_station' => $this->station_id,
            'performance_id' => $this->performance_id
        ];
        //return Excel::download(new PenilaianExport, 'penilaian.xlsx');
        return (new PenilaianExport)->filterData($filtered)->download('penilaian.xlsx');
    }
}
