<?php

namespace App\Livewire\Admin\Tiang;

use App\Imports\TiangImport;
use App\Models\Tiang;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

#[Title('Tiang')]
class IndexTiang extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $perPage = 50;

    #[Validate('required|file|max:2000')]
    public $fileTiang;

    public function render()
    {
        return view('livewire.admin.tiang.index-tiang');
    }

    #[Computed()]
    public function tiangs()
    {
        return Tiang::orderBy('kode', 'asc')->paginate($this->perPage);
    }

    public function deleteTiang(Tiang $tiang)
    {
        if($tiang)
        {
            //destroy
            $tiang->delete();
        }
    }

    public function addTiang()
    {
        $this->validate();

        Excel::import(new TiangImport, $this->fileTiang);

        return redirect('/admin/tiang')->with('success', 'All good!');
    }
}
