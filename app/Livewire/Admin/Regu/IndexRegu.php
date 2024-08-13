<?php

namespace App\Livewire\Admin\Regu;

use App\Models\Regu;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Regu')]
class IndexRegu extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.admin.regu.index-regu');
    }

    #[Computed()]
    public function regus()
    {
        return Regu::where('nama', 'like', '%'.$this->search.'%')
                ->orderBy('kode', 'asc')->get();
    }

    public function deleteRegu(Regu $regu)
    {
        if($regu)
        {
            //destroy
            $regu->delete();
        }
    }
}
