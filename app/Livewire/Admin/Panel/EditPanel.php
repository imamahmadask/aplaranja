<?php

namespace App\Livewire\Admin\Panel;

use App\Models\Jalan;
use App\Models\Panel;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Edit Panel')]
class EditPanel extends Component
{
    #[Validate('required')]
    public $panelId, $kode, $kwh, $idpel, $saklar, $jaringan, $kordinat, $jalan_id;

    public $jalans;

    public function render()
    {
        return view('livewire.admin.panel.edit-panel');
    }

    public function mount($id)
    {
        $panel = Panel::find($id);

        $this->panelId = $panel->id;
        $this->kode = $panel->kode;
        $this->kwh = $panel->kwh;
        $this->idpel = $panel->idpel;
        $this->jaringan = $panel->jaringan;
        $this->saklar = $panel->saklar;
        $this->kordinat = $panel->kordinat;
        $this->jalan_id = $panel->jalan_id;

        $this->jalans = Jalan::all();
    }

    public function updatePanel()
    {
        $this->validate();

        $panel = Panel::find($this->panelId);

        $panel->update([
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
}
