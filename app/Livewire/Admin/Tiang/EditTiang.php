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
    public $tiangId, $kode, $kategori, $jenis, $lengan, $tahun_pengadaan, $jaringan, $kordinat, $panel_id, $lampu;

    public $panels;

    public function render()
    {
        return view('livewire.admin.tiang.edit-tiang');
    }

    public function mount($id)
    {
        $tiang = Tiang::find($id);

        $this->tiangId = $tiang->id;
        $this->kode = $tiang->kode;
        $this->kategori = $tiang->kategori;
        $this->jenis = $tiang->jenis;
        $this->lengan = $tiang->lengan;
        $this->tahun_pengadaan = $tiang->tahun_pengadaan;
        $this->jaringan = $tiang->jaringan;
        $this->kordinat = $tiang->kordinat;
        $this->panel_id = $tiang->panel_id;
        $this->lampu = $tiang->lampu;

        $this->panels = Panel::all();
    }

    public function updateTiang()
    {
        $this->validate();

        $tiang = Tiang::find($this->tiangId);

        $tiang->update([
            'kode' => $this->kode,
            'kategori' => $this->kategori,
            'jenis' => $this->jenis,
            'lengan' => $this->lengan,
            'tahun_pengadaan' => $this->tahun_pengadaan,
            'jaringan' => $this->jaringan,
            'kordinat' => $this->kordinat,
            'panel_id' => $this->panel_id,
            'lampu' => $this->lampu,
        ]);

        $this->reset();

        $this->redirect('/admin/tiang');
    }
}
