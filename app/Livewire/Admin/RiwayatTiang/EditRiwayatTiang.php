<?php

namespace App\Livewire\Admin\RiwayatTiang;

use App\Models\Regu;
use App\Models\RiwayatTiang;
use App\Models\Tiang;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Edit Riwayat Tiang')]
class EditRiwayatTiang extends Component
{
    #[Validate('required')]
    public $riwayat_tiang_id, $tanggal, $jenis, $kerusakan, $perbaikan, $tiang_id, $regu_id, $alat, $bahan;

    public $tiangs, $regus, $keterangan;

    public function render()
    {
        return view('livewire.admin.riwayat-tiang.edit-riwayat-tiang');
    }

    public function mount($id)
    {
        $riwayat_tiang = RiwayatTiang::find($id);

        $this->riwayat_tiang_id = $riwayat_tiang->id;
        $this->tiang_id = $riwayat_tiang->tiang_id;
        $this->regu_id = $riwayat_tiang->regu_id;
        $this->tanggal = $riwayat_tiang->tanggal;
        $this->jenis = $riwayat_tiang->jenis;
        $this->kerusakan = $riwayat_tiang->kerusakan;
        $this->perbaikan = $riwayat_tiang->perbaikan;
        $this->alat = $riwayat_tiang->alat;
        $this->bahan = $riwayat_tiang->bahan;

        $this->tiangs = Tiang::orderBy('kode', 'asc')->get();
        $this->regus = Regu::orderBy('kode', 'asc')->get();
    }

    public function updateRiwayatTiang()
    {
        $this->validate();

        $riwayat_tiang = RiwayatTiang::find($this->riwayat_tiang_id);

        $riwayat_tiang->update([
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
}
