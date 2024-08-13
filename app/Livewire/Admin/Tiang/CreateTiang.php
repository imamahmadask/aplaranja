<?php

namespace App\Livewire\Admin\Tiang;

use App\Models\Panel;
use App\Models\Tiang;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Create Tiang')]
class CreateTiang extends Component
{
    #[Validate('required')]
    public $kode, $kategori, $jenis, $lengan, $tahun_pengadaan, $jaringan, $kordinat, $panel_id, $lampu, $posisi_tiang;

    public $panels, $lat, $long, $kode_panel;

    public function render()
    {
        return view('livewire.admin.tiang.create-tiang');
    }

    public function addTiang()
    {
        $this->validate();

        $this->getKordinat($this->kordinat);

        Tiang::create([
            'kode' => $this->kode_panel.'-'.$this->kode,
            'kategori' => $this->kategori,
            'jenis' => $this->jenis,
            'lengan' => $this->lengan,
            'tahun_pengadaan' => $this->tahun_pengadaan,
            'jaringan' => $this->jaringan,
            'lat' => $this->lat,
            'long' => $this->long,
            'panel_id' => $this->panel_id,
            'lampu' => $this->lampu,
            'posisi_tiang' => $this->posisi_tiang,
        ]);

        $this->reset();

        $this->redirect('/admin/tiang');
    }

    public function mount()
    {
        $this->panels = Panel::orderBy('kode', 'asc')->get();
    }

    public function getKordinat($value){
        $pecah = explode(", ", $value);
        $this->lat = $pecah[0];
        $this->long = $pecah[1];
    }

    public function updatedPanelId($value)
    {
        $panel = Panel::find($value);
        $this->kode_panel = $panel->kode;
    }
}
