<?php

namespace App\Livewire\Admin\Regu;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Regu')]
class IndexRegu extends Component
{
    public function render()
    {
        return view('livewire.admin.regu.index-regu');
    }
}
