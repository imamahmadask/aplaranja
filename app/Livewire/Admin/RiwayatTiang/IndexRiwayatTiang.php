<?php

namespace App\Livewire\Admin\RiwayatTiang;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Riwayat Tiang')]
class IndexRiwayatTiang extends Component
{
    public function render()
    {
        return view('livewire.admin.riwayat-tiang.index-riwayat-tiang');
    }
}
