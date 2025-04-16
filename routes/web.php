<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Livewire\Admin\Dashboard\IndexDashboard;
use App\Livewire\Admin\Info\CreateInfo;
use App\Livewire\Admin\Info\EditInfo;
use App\Livewire\Admin\Info\IndexInfo;
use App\Livewire\Admin\Jalan\CreateJalan;
use App\Livewire\Admin\Jalan\DetailJalan;
use App\Livewire\Admin\Jalan\EditJalan;
use App\Livewire\Admin\Jalan\IndexJalan;
use App\Livewire\Admin\Lampu\IndexLampu;
use App\Livewire\Admin\Panel\CreatePanel;
use App\Livewire\Admin\Panel\EditPanel;
use App\Livewire\Admin\Panel\IndexPanel;
use App\Livewire\Admin\Regu\CreateRegu;
use App\Livewire\Admin\Regu\EditRegu;
use App\Livewire\Admin\Regu\IndexRegu;
use App\Livewire\Admin\Riwayat\IndexRiwayat;
use App\Livewire\Admin\RiwayatPanel\CreateRiwayatPanel;
use App\Livewire\Admin\RiwayatPanel\EditRiwayatPanel;
use App\Livewire\Admin\RiwayatPanel\IndexRiwayatPanel;
use App\Livewire\Admin\RiwayatTiang\CreateRiwayatTiang;
use App\Livewire\Admin\RiwayatTiang\EditRiwayatTiang;
use App\Livewire\Admin\RiwayatTiang\IndexRiwayatTiang;
use App\Livewire\Admin\Tiang\CreateTiang;
use App\Livewire\Admin\Tiang\EditTiang;
use App\Livewire\Admin\Tiang\IndexTiang;
use App\Livewire\Admin\Users\CreateUser;
use App\Livewire\Admin\Users\EditUser;
use App\Livewire\Admin\Users\IndexUser;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('detail/{kode}', [WelcomeController::class, 'show'])->name('detail-tiang');

Route::middleware(['cekRole:Admin,User,Guest'])->group(function () {
    Route::get('admin/dashboard', IndexDashboard::class)->name('dashboard'); // admin dashboard

    Route::get('admin/jalan', IndexJalan::class)->name('jalan.index'); // Jalan
    Route::get('admin/jalan/{id}/detail', DetailJalan::class)->name('jalan.detail'); // Detail Jalan

    Route::get('admin/panel', IndexPanel::class)->name('panel.index'); // Panel

    Route::get('admin/tiang', IndexTiang::class)->name('tiang.index'); // Tiang

    Route::get('admin/lampu', IndexLampu::class)->name('lampu.index'); // Lampu

    Route::get('admin/riwayat_panel', IndexRiwayatPanel::class)->name('riwayatPanel.index'); // Riwayat Panel
    Route::get('admin/riwayat_panel/create', CreateRiwayatPanel::class)->name('riwayatPanel.create'); // Riwayat Panel
    Route::get('admin/riwayat_panel/{id}/edit', EditRiwayatPanel::class)->name('riwayatPanel.edit'); // Riwayat Panel

    Route::get('admin/riwayat_tiang', IndexRiwayatTiang::class)->name('riwayatTiang.index'); // Riwayat Tiang
    Route::get('admin/riwayat_tiang/create', CreateRiwayatTiang::class)->name('riwayatTiang.create'); // Riwayat Tiang
    Route::get('admin/riwayat_tiang/{id}/edit', EditRiwayatTiang::class)->name('riwayatTiang.edit'); // Riwayat Tiang

    Route::get('admin/regu', IndexRegu::class)->name('regu.index'); // regu

    Route::get('admin/info', IndexInfo::class)->name('info.index'); // Info

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['cekRole:Admin,User'])->group(function () {
    Route::get('admin/jalan/create', CreateJalan::class)->name('jalan.create'); // Create Jalan
    Route::get('admin/jalan/{id}/edit', EditJalan::class)->name('jalan.edit'); // Edit Jalan

    Route::get('admin/panel/create', CreatePanel::class)->name('panel.create'); // Create panel
    Route::get('admin/panel/{id}/edit', EditPanel::class)->name('panel.edit'); // Edit panel

    Route::get('admin/tiang/create', CreateTiang::class)->name('tiang.create'); // Create Tiang
    Route::get('admin/tiang/{id}/edit', EditTiang::class)->name('tiang.edit'); // Edit Tiang

    Route::get('admin/regu/create', CreateRegu::class)->name('regu.create'); // regu
    Route::get('admin/regu/{id}/edit', EditRegu::class)->name('regu.edit'); // regu

    Route::get('admin/info/create', CreateInfo::class)->name('info.create'); // Info
    Route::get('admin/info/{id}/edit', EditInfo::class)->name('info.edit'); // Info
});

Route::middleware(['cekRole:Admin'])->group(function () {
    Route::get('admin/users', IndexUser::class)->name('users.index'); // User
    Route::get('admin/users/create', CreateUser::class)->name('users.create'); // User
    Route::get('admin/users/{id}/edit', EditUser::class)->name('users.edit'); // User
});

require __DIR__.'/auth.php';
