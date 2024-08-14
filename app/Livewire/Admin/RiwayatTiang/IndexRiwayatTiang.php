<?php

namespace App\Livewire\Admin\RiwayatTiang;

use App\Models\RiwayatTiang;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Riwayat Tiang')]
class IndexRiwayatTiang extends Component
{
    public function render()
    {
        return view('livewire.admin.riwayat-tiang.index-riwayat-tiang');
    }

    #[Computed()]
    public function riwayatTiangs()
    {
        return RiwayatTiang::orderBy('tanggal', 'desc')->get();
    }

    public function deleteRiwayatTiang(RiwayatTiang $riwayatTiang)
    {
        if($riwayatTiang)
        {
            //destroy
            $riwayatTiang->delete();
        }
    }
}
