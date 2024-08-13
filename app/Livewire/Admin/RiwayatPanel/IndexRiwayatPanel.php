<?php

namespace App\Livewire\Admin\RiwayatPanel;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Riwayat Panel')]
class IndexRiwayatPanel extends Component
{
    public function render()
    {
        return view('livewire.admin.riwayat-panel.index-riwayat-panel');
    }
}
