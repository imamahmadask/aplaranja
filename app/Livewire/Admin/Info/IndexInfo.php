<?php

namespace App\Livewire\Admin\Info;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Info')]
class IndexInfo extends Component
{
    public function render()
    {
        return view('livewire.admin.info.index-info');
    }
}
