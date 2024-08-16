<?php

namespace App\Livewire\Admin\RiwayatPanel;

use App\Models\Panel;
use App\Models\Regu;
use App\Models\RiwayatPanel;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Create Riwayat Panel')]
class CreateRiwayatPanel extends Component
{
    #[Validate('required')]
    public $tanggal, $jenis, $kerusakan, $perbaikan, $panel_id, $regu_id, $alat, $bahan;

    public $panels, $regus, $keterangan;

    public function render()
    {
        return view('livewire.admin.riwayat-panel.create-riwayat-panel');
    }

    public function addRiwayatPanel()
    {
        $this->validate();

        RiwayatPanel::create([
            'tanggal' => $this->tanggal,
            'jenis' => $this->jenis,
            'kerusakan' => $this->kerusakan,
            'perbaikan' => $this->perbaikan,
            'keterangan' => $this->keterangan,
            'panel_id' => $this->panel_id,
            'regu_id' => $this->regu_id,
            'alat' => $this->alat,
            'bahan' => $this->bahan,
        ]);

        $this->reset();

        $this->redirect('/admin/riwayat_panel');
    }

    public function mount()
    {
        $this->panels = Panel::orderBy('kode', 'asc')->get();
        $this->regus = Regu::orderBy('kode', 'asc')->get();
    }
}
