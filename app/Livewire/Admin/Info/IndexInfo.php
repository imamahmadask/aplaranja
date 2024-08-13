<?php

namespace App\Livewire\Admin\Info;

use App\Models\InfoUmum;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Info')]
class IndexInfo extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.admin.info.index-info');
    }

    #[Computed()]
    public function infos()
    {
        return InfoUmum::where('nama', 'like', '%'.$this->search.'%')
                ->orderBy('nama', 'asc')->get();
    }

    public function deleteInfo(InfoUmum $infoUmum)
    {
        if($infoUmum)
        {
            //destroy
            $infoUmum->delete();
        }
    }
}
