<?php

namespace App\Exports;

use App\Models\Penilaian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PenilaianExport implements FromView
{
    use Exportable;

    public function periode(string $periode)
    {
        $this->periode = $periode;
        return $this;
    }

    public function filterData(Array $filtered)
    {
        $this->filtered = $filtered;
        return $this;
    }

    // public function query()
    // {
    //     return Penilaian::query()->where('periode', $this->periode);
    // }

    public function view(): View
    {
        return view('livewire.penilaian.export', [
            'penilaian' => Penilaian::when($this->filtered['tahun_penilaian'],function($query) {
                                        return $query->where('tahun_penilaian',$this->filtered['tahun_penilaian']);
                                    })->when($this->filtered['periode'],function($query) {
                                        return $query->where('periode',$this->filtered['periode']);
                                    })->when($this->filtered['no_station'],function($query) {
                                        return $query->where('no_station',$this->filtered['no_station']);
                                    })->when($this->filtered['performance_id'],function($query) {
                                        return $query->where('performance_id',$this->filtered['performance_id']);
                                    })
                                    ->orderBy('no_station', 'desc')
                                    ->get()
                                ]);
    }
}
