<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Livewire\Osce\UpdateStatus;
use App\Http\Controllers\StationController;
use App\Http\Controllers\DashboardController;
use App\Livewire\Osce\Index;


Route::view('/', 'welcome')->middleware('guest');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/station', \App\Livewire\Station\Index::class)->name('station');
    Route::get('/station/tambah', \App\Livewire\Station\Form::class)->name('tambah-station');
    Route::get('/station/edit/{id}', \App\Livewire\Station\Edit::class)->name('edit-station');
    Route::get('/station/detail/{id}', \App\Livewire\Station\Detail\Index::class)->name('detail-station');
    Route::get('/station/tambah-kriteria/{id}', \App\Livewire\Station\Detail\Form::class)->name('tambah-kriteria');
    Route::get('/station/edit-kriteria/{id}', \App\Livewire\Station\Detail\EditKriteria::class)->name('edit-kriteria');
    Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');
    Route::get('/osce', \App\Livewire\Osce\Index::class)->name('osce');
    Route::get('/mahasiswa', \App\Livewire\Mahasiswa\Index::class)->name('mahasiswa');
    Route::get('/dosen', \App\Livewire\Dosen\Index::class)->name('dosen');
    Route::get('/penilaian/form/{id}', \App\Livewire\Penilaian\Form::class)->name('form-penilaian');
    Route::get('/daftar-nilai', \App\Livewire\Penilaian\Index::class)->name('nilai');
    Route::get('/daftar-nilai-individu', \App\Livewire\Nilai\Individu::class)->name('nilai-individu');
    Route::get('/setup-user', \App\Livewire\User\Index::class)->name('setup-user')->middleware(AdminMiddleware::class);
    Route::get('/profile', \App\Livewire\Profile\Index::class)->name('profile');

    // Route::get('/paktas', [PaktaController::class, 'index'])->name('paktas.index');
    // Route::get('/station/update/status', \App\Livewire\Station\UpdateStatus::class,'UpdateStation')->name('update-station');
    Route::get('/station/update/status', UpdateStatus::class)->name('update-station');
    Route::get('/stations/selected', [StationController::class, 'showSelected'])->name('stations.selected');
    // Route::get('/update-station', UpdateStatus::class)->name('update-station');
    // Route::get('/dashboard/osce', [DashboardController::class, 'showDashboard'])->name('dashboard.osce');
    // Route::get('/osce/index', [Index::class, 'showDashboard'])->name('livewire.osce.index');
});


require __DIR__.'/auth.php';
