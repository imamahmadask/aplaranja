<?php

namespace App\Livewire\Admin\RiwayatTiang;

use App\Models\Regu;
use App\Models\RiwayatTiang;
use App\Models\Tiang;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Create Riwayat Tiang')]
class CreateRiwayatTiang extends Component
{
    #[Validate('required')]
    public $tanggal, $jenis, $kerusakan, $perbaikan, $tiang_id, $regu_id, $alat, $bahan;

    public $tiangs, $regus, $keterangan;

    public function render()
    {
        return view('livewire.admin.riwayat-tiang.create-riwayat-tiang');
    }

    public function addRiwayatTiang()
    {
        $this->validate();

        RiwayatTiang::create([
            'tanggal' => $this->tanggal,
            'jenis' => $this->jenis,
            'kerusakan' => $this->kerusakan,
            'perbaikan' => $this->perbaikan,
            'keterangan' => $this->keterangan,
            'tiang_id' => $this->tiang_id,
            'regu_id' => $this->regu_id,
            'alat' => $this->alat,
            'bahan' => $this->bahan,
        ]);

        $this->reset();

        $this->redirect('/admin/riwayat_tiang');
    }

    public function mount()
    {
        $this->tiangs = Tiang::orderBy('kode', 'asc')->get();
        $this->regus = Regu::orderBy('kode', 'asc')->get();
    }
}
