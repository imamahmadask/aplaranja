<?php

namespace App\Livewire\Admin\Jalan;

use App\Models\Jalan;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Jalan')]
class IndexJalan extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.admin.jalan.index-jalan');
    }

    #[Computed()]
    public function jalans()
    {
        return Jalan::where('nama', 'like', '%'.$this->search.'%')
                ->orderBy('kode', 'asc')->get();
    }

    public function deleteJalan(Jalan $jalan)
    {
        if($jalan)
        {
            //destroy
            $jalan->delete();
        }
    }
}
