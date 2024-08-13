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

    public $jalans, $lat, $long, $kode_jalan;

    public function render()
    {
        return view('livewire.admin.panel.create-panel');
    }

    public function addPanel()
    {
        $this->validate();

        $this->getKordinat($this->kordinat);

        Panel::create([
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

    public function mount()
    {
        $this->jalans = Jalan::all();
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
