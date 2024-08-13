<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\Dashboard\IndexDashboard;
use App\Livewire\Admin\Info\IndexInfo;
use App\Livewire\Admin\Jalan\CreateJalan;
use App\Livewire\Admin\Jalan\EditJalan;
use App\Livewire\Admin\Jalan\IndexJalan;
use App\Livewire\Admin\Lampu\IndexLampu;
use App\Livewire\Admin\Panel\CreatePanel;
use App\Livewire\Admin\Panel\EditPanel;
use App\Livewire\Admin\Panel\IndexPanel;
use App\Livewire\Admin\Regu\IndexRegu;
use App\Livewire\Admin\Riwayat\IndexRiwayat;
use App\Livewire\Admin\RiwayatPanel\IndexRiwayatPanel;
use App\Livewire\Admin\RiwayatTiang\IndexRiwayatTiang;
use App\Livewire\Admin\Tiang\CreateTiang;
use App\Livewire\Admin\Tiang\EditTiang;
use App\Livewire\Admin\Tiang\IndexTiang;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('admin/dashboard', IndexDashboard::class)->name('dashboard'); // admin dashboard

    Route::get('admin/jalan', IndexJalan::class)->name('jalan.index'); // Jalan
    Route::get('admin/jalan/create', CreateJalan::class)->name('jalan.create'); // Create Jalan
    Route::get('admin/jalan/{id}/edit', EditJalan::class)->name('jalan.edit'); // Edit Jalan

    Route::get('admin/panel', IndexPanel::class)->name('panel.index'); // Panel
    Route::get('admin/panel/create', CreatePanel::class)->name('panel.create'); // Create panel
    Route::get('admin/panel/{id}/edit', EditPanel::class)->name('panel.edit'); // Edit panel

    Route::get('admin/tiang', IndexTiang::class)->name('tiang.index'); // Tiang
    Route::get('admin/tiang/create', CreateTiang::class)->name('tiang.create'); // Create Tiang
    Route::get('admin/tiang/{id}/edit', EditTiang::class)->name('tiang.edit'); // Edit Tiang

    Route::get('admin/lampu', IndexLampu::class)->name('lampu.index'); // Lampu

    Route::get('admin/riwayat_panel', IndexRiwayatPanel::class)->name('riwayatPanel.index'); // Lampu

    Route::get('admin/riwayat_tiang', IndexRiwayatTiang::class)->name('riwayatTiang.index'); // Lampu

    Route::get('admin/regu', IndexRegu::class)->name('regu.index'); // Lampu

    Route::get('admin/info', IndexInfo::class)->name('info.index'); // Lampu

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
