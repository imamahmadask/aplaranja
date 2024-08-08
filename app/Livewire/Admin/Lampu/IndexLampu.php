<?php

namespace App\Livewire\Admin\Lampu;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Lampu')]
class IndexLampu extends Component
{
    public function render()
    {
        return view('livewire.admin.lampu.index-lampu');
    }
}
