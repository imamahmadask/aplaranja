<?php

namespace App\Livewire\Admin\RiwayatPanel;

use App\Models\Panel;
use App\Models\Regu;
use App\Models\RiwayatPanel;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Edit Riwayat Panel')]
class EditRiwayatPanel extends Component
{
    #[Validate('required')]
    public $riwayat_panel_id, $tanggal, $jenis, $kerusakan, $perbaikan, $panel_id, $regu_id, $alat, $bahan;

    public $panels, $regus, $keterangan;

    public function render()
    {
        return view('livewire.admin.riwayat-panel.edit-riwayat-panel');
    }

    public function mount($id)
    {
        $riwayat_panel = RiwayatPanel::find($id);

        $this->riwayat_panel_id = $riwayat_panel->id;
        $this->panel_id = $riwayat_panel->panel_id;
        $this->regu_id = $riwayat_panel->regu_id;
        $this->tanggal = $riwayat_panel->tanggal;
        $this->jenis = $riwayat_panel->jenis;
        $this->kerusakan = $riwayat_panel->kerusakan;
        $this->perbaikan = $riwayat_panel->perbaikan;
        $this->alat = $riwayat_panel->alat;
        $this->bahan = $riwayat_panel->bahan;

        $this->panels = Panel::orderBy('kode', 'asc')->get();
        $this->regus = Regu::orderBy('kode', 'asc')->get();
    }

    public function updateRiwayatPanel()
    {
        $this->validate();

        $riwayat_panel = RiwayatPanel::find($this->riwayat_panel_id);

        $riwayat_panel->update([
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
}
