<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;

class DashboardController extends Controller
{
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
        return view('dashboard.osce', compact('data'));
    }
}
