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
        // Ambil data berdasarkan ID yang dipilih
        $data = Station::whereIn('id', $this->selectedStations)->get();

        // Redirect ke halaman dashboard dengan data
        return redirect()->route('osce', ['selectedStations' => $this->selectedStations]);
    }

    public function render()
    {
        return view('livewire.osce.update-status', [
            'stations' => $this->stations,
        ]);
    }
}
