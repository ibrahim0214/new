<?php

namespace App\Livewire\Osce;

use App\Models\Station;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $stations; // Data station
    public $selectedStations = []; // Data yang dipilih

    public function mount()
    {
        $this->stations = Station::all();
    }

    public function showSelected()
    {
        // ini untuk update jadi show saat checkbox di klik
        Station::whereIn('id', $this->selectedStations)->update(['status' => 'show']);
        // nah ini yg ku maksud redirect ke halaman index nya osce
        return redirect()->route('osce');
    }

    public function render()
    {
        return view('livewire.osce.update-status', [
            'stations' => $this->stations,
        ]);
    }
}