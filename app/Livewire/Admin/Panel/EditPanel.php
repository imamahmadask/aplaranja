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

    public $jalans, $lat, $long, $kode_jalan;

    public function render()
    {
        return view('livewire.admin.panel.edit-panel');
    }

    public function mount($id)
    {
        $panel = Panel::find($id);

        $this->panelId = $panel->id;
        $this->kode = substr($panel->kode, strpos($panel->kode, '-') + 1);
        $this->kode_jalan = substr($panel->kode, 0, strpos($panel->kode, '-'));
        $this->kwh = $panel->kwh;
        $this->idpel = $panel->idpel;
        $this->jaringan = $panel->jaringan;
        $this->saklar = $panel->saklar;
        $this->kordinat = $panel->lat.", ".$panel->long;
        $this->jalan_id = $panel->jalan_id;

        $this->jalans = Jalan::all();
    }

    public function updatePanel()
    {
        $this->validate();

        $panel = Panel::find($this->panelId);

        $this->getKordinat($this->kordinat);

        $panel->update([
            'kode' => $this->kode_jalan.'-'.$this->kode,
            'kwh' => $this->kwh,
            'idpel' => $this->idpel,
            'jaringan' => $this->jaringan,
            'saklar' => $this->saklar,
            'lat' => $this->lat,
            'long' => $this->long,
            'jalan_id' => $this->jalan_id
        ]);

        $this->reset();

        $this->redirect('/admin/panel');
    }

    public function getKordinat($value){
        $pecah = explode(", ", $value);
        $this->lat = $pecah[0];
        $this->long = $pecah[1];
    }

    public function updatedJalanId($value)
    {
        $jalan = Jalan::find($value);
        $this->kode_jalan = $jalan->kode;
    }
}
