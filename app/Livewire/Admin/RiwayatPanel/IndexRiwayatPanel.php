<?php

namespace App\Livewire\Admin\RiwayatPanel;

use App\Models\RiwayatPanel;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Riwayat Panel')]
class IndexRiwayatPanel extends Component
{
    public function render()
    {
        return view('livewire.admin.riwayat-panel.index-riwayat-panel');
    }

    #[Computed()]
    public function riwayatPanels()
    {
        return RiwayatPanel::orderBy('tanggal', 'desc')->get();
    }

    public function deleteRiwayatPanel(RiwayatPanel $riwayatPanel)
    {
        if($riwayatPanel)
        {
            //destroy
            $riwayatPanel->delete();
        }
    }
}
