<?php

namespace App\Livewire\Admin\Tiang;

use App\Models\Panel;
use App\Models\Tiang;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Edit Tiang')]
class EditTiang extends Component
{
    #[Validate('required')]
    public $tiangId, $kode, $kategori, $jenis, $lengan, $tahun_pengadaan, $jaringan, $kordinat, $panel_id, $lampu, $posisi_tiang;

    public $panels, $lat, $long, $kode_panel;

    public function render()
    {
        return view('livewire.admin.tiang.edit-tiang');
    }

    public function mount($id)
    {
        $tiang = Tiang::find($id);

        $this->tiangId = $tiang->id;
        $this->kode = substr($tiang->kode, strrpos($tiang->kode, '-') + 1);
        $this->kode_panel = substr($tiang->kode, 0, strrpos($tiang->kode, '-'));
        $this->kategori = $tiang->kategori;
        $this->jenis = $tiang->jenis;
        $this->lengan = $tiang->lengan;
        $this->tahun_pengadaan = $tiang->tahun_pengadaan;
        $this->jaringan = $tiang->jaringan;
        $this->kordinat = $tiang->lat.", ".$tiang->long;
        $this->panel_id = $tiang->panel_id;
        $this->lampu = $tiang->lampu;
        $this->posisi_tiang = $tiang->posisi_tiang;

        $this->panels = Panel::orderBy('kode', 'asc')->get();
    }

    public function updateTiang()
    {
        $this->validate();

        $tiang = Tiang::find($this->tiangId);

        $this->getKordinat($this->kordinat);

        $tiang->update([
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
