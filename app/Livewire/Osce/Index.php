<?php

namespace App\Livewire\Osce;

use App\Models\Station;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;



class Index extends Component
{
    public function render()
    {
        $data = Station::where('status','show')->get();
        return view('livewire.osce.index', compact('data'));
    }

    public function penilaian($id)
    {
        $enc_id = Crypt::encryptString($id);
        return $this->redirect('/penilaian/form/'.$enc_id, navigate:true);
    }

    public function UpdateStation()
    {
        $data = Station::all();
        return view('livewire.osce.update-status', compact('data'));
    }

    /**
     * Tampilkan halaman dashboard dengan data yang dipilih.
     */
    public function showDashboard(Request $request)
    {
        // Ambil ID yang dipilih dari query parameter
        $selectedIds = $request->input('selectedStations', []);

        // Ambil data dari database berdasarkan ID yang dipilih
        $data = Station::whereIn('id', $selectedIds)->get();

        // Tampilkan view dashboard
        return view('livewire.osce.index', compact('data'));
    }
}
