<?php

namespace App\Livewire\Admin\Panel;

use App\Models\Jalan;
use App\Models\Panel;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Create Panel')]
class CreatePanel extends Component
{
    #[Validate('required')]
    public $kode, $kwh, $idpel, $saklar, $jaringan, $kordinat, $jalan_id;

    public $jalans;

    public function render()
    {
        return view('livewire.admin.panel.create-panel');
    }

    public function addPanel()
    {
        $this->validate();

        Panel::create([
            'kode' => $this->kode,
            'kwh' => $this->kwh,
            'idpel' => $this->idpel,
            'jaringan' => $this->jaringan,
            'saklar' => $this->saklar,
            'kordinat' => $this->kordinat,
            'jalan_id' => $this->jalan_id
        ]);

        $this->reset();

        $this->redirect('/admin/panel');
    }

    public function mount()
    {
        $this->jalans = Jalan::all();
    }
}
