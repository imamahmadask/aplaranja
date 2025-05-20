<?php

namespace App\Livewire\Admin\Jalan;

use App\Imports\JalanImport;
use App\Imports\JalanUpdate;
use App\Models\Jalan;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

#[Title('Jalan')]
class IndexJalan extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $perPage = 25;
    public $search = '';

    #[Validate('required|file|max:2000|mimes:xls,xlsx')]
    public $fileJalan;

    public function render()
    {
        return view('livewire.admin.jalan.index-jalan');
    }

    #[Computed()]
    public function jalans()
    {
        return Jalan::where('nama', 'like', '%'.$this->search.'%')
                ->orWhere('kode', 'like', '%'.$this->search.'%')
                ->orderBy('kode', 'asc')
                ->paginate($this->perPage);
    }

    public function deleteJalan(Jalan $jalan)
    {
        if($jalan)
        {
            //destroy
            $jalan->delete();
        }
    }

    public function addJalan()
    {
        $this->validate();

        // Excel::import(new JalanImport(), $this->fileJalan);
        Excel::import(new JalanUpdate(), $this->fileJalan);

        return redirect('/admin/jalan')->with('success', 'All good!');
    }

}
