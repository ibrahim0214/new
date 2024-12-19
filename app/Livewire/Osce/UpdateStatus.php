<?php

namespace App\Livewire\Osce;

use App\Models\Station;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $stations = []; // Data stations
    public $selectedStations = []; // Data yang dipilih oleh pengguna
    
    public function mount()
    {
        $this->stations = Station::all();

        // Inisialisasi selectedStations berdasarkan status 'show'
        $this->selectedStations = $this->stations
            ->where('status', 'show')
            ->pluck('id')
            ->toArray();
    }

    public function showSelected()
    {   

         // Debug data selectedStations
        logger($this->selectedStations); // Periksa di log

        // Update semua station yang dipilih ke 'show'
        Station::whereIn('id', $this->selectedStations)->update(['status' => 'show']);

        // Update semua station yang tidak dipilih ke 'hidden'
        Station::whereNotIn('id', $this->selectedStations)->update(['status' => 'hidden']);

        // Redirect ke halaman index OSCE
        return redirect()->route('osce');
    }

    public function render()
    {
        return view('livewire.osce.update-status', ['stations' => $this->stations]);
    }
}