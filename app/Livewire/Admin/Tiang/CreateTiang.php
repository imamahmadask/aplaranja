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
    public $kode, $kategori, $jenis, $lengan, $tahun_pengadaan, $jaringan, $kordinat, $panel_id, $lampu;

    public $panels;

    public function render()
    {
        return view('livewire.admin.tiang.create-tiang');
    }

    public function addTiang()
    {
        $this->validate();

        Tiang::create([
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

    public function mount()
    {
        $this->panels = Panel::all();
    }
}
