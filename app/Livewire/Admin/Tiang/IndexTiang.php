<?php

namespace App\Livewire\Admin\Tiang;

use App\Models\Tiang;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Tiang')]
class IndexTiang extends Component
{
    public function render()
    {
        return view('livewire.admin.tiang.index-tiang');
    }

    #[Computed()]
    public function tiangs()
    {
        return Tiang::all();
    }

    public function deleteTiang(Tiang $tiang)
    {
        if($tiang)
        {
            //destroy
            $tiang->delete();
        }
    }
}
