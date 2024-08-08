<?php

namespace App\Livewire\Admin\Panel;

use App\Models\Panel;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Panel')]
class IndexPanel extends Component
{
    public function render()
    {
        return view('livewire.admin.panel.index-panel');
    }

    #[Computed()]
    public function panels()
    {
        return Panel::orderBy('kode', 'asc')->get();
    }

    public function deletePanel(Panel $panel)
    {
        if($panel)
        {
            //destroy
            $panel->delete();
        }
    }
}
