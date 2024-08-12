<?php

namespace App\Livewire\Admin\Panel;

use App\Imports\PanelImport;
use App\Models\Panel;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

#[Title('Panel')]
class IndexPanel extends Component
{
    use WithFileUploads;

    #[Validate('required|file|max:2000')]
    public $filePanel;

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

    public function addPanel()
    {
        $this->validate();

        Excel::import(new PanelImport, $this->filePanel);

        return redirect('/admin/panel')->with('success', 'All good!');
    }
}
