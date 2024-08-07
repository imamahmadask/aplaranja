<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\Dashboard\Index as DashboardIndex;

use App\Livewire\Admin\Jalan\CreateJalan;
use App\Livewire\Admin\Jalan\EditJalan;
use App\Livewire\Admin\Jalan\IndexJalan;
use App\Livewire\Admin\Lampu\Index as LampuIndex;
use App\Livewire\Admin\Panel\Index as PanelIndex;
use App\Livewire\Admin\Tiang\Index as TiangIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', DashboardIndex::class)->name('dashboard'); // admin dashboard

    Route::get('/admin/jalan', IndexJalan::class)->name('jalan.index'); // Jalan
    Route::get('/admin/jalan/create', CreateJalan::class)->name('jalan.create'); // Create Jalan
    Route::get('/admin/jalan/{$id}/edit', EditJalan::class)->name('jalan.edit'); // Edit Jalan

    Route::get('/admin/panel', PanelIndex::class)->name('panel'); // Panel

    Route::get('/admin/tiang', TiangIndex::class)->name('tiang'); // Tiang

    Route::get('/admin/lampu', LampuIndex::class)->name('lampu'); // Lampu

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
