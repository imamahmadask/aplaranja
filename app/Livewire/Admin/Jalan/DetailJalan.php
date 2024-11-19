<?php

namespace App\Livewire\Admin\Jalan;

use App\Models\Jalan;
use App\Models\Panel;
use App\Models\Tiang;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Detail Jalan')]
class DetailJalan extends Component
{
    public $jalanId, $kode, $nama, $panjang, $lebar, $kordinat, $is_survey, $ket;
    public $countPanels, $countTiangs;
    public $countTiang, $countOrnamen, $countGawang;
    public $countBesi, $countGalvanis;
    public $countLed, $countSont, $countBohlam;
    public function render()
    {
        return view('livewire.admin.jalan.detail-jalan');
    }

    public function mount($id)
    {
        $jalan = Jalan::find($id);

        $this->jalanId = $jalan->id;
        $this->kode = $jalan->kode;
        $this->nama = $jalan->nama;
        $this->panjang = $jalan->panjang;
        $this->lebar = $jalan->lebar;
        $this->kordinat = $jalan->lat.", ".$jalan->long;
        $this->is_survey = $jalan->is_survey;
        $this->ket = $jalan->ket;

        $detail = Jalan::where('id', $this->jalanId)->withCount(['panel', 'tiang'])->get();

        $this->countPanels = $detail[0]->panel_count;
        $this->countTiangs = $detail[0]->tiang_count;
        $this->countJenisTiang();
        $this->countKategoriTiang();
        $this->countKategoriLampu();
    }

    public function countKategoriTiang()
    {
        $panels = Panel::where('jalan_id', $this->jalanId)->get();
        foreach ($panels as $panel) {
            $this->countTiang += $panel->tiang->where('kategori', 'Tiang')->count();
            $this->countOrnamen += $panel->tiang->where('kategori', 'Ornamen')->count();
            $this->countGawang += $panel->tiang->where('kategori', 'Gawang')->count();
        }
    }

    public function countJenisTiang()
    {
        $panels = Panel::where('jalan_id', $this->jalanId)->get();
        foreach ($panels as $panel) {
            $this->countBesi += $panel->tiang->where('jenis', 'Besi')->count();
            $this->countGalvanis += $panel->tiang->where('jenis', 'Galvanis')->count();
        }
    }

    public function countKategoriLampu()
    {
        $panels = Panel::where('jalan_id', $this->jalanId)->get();
        foreach ($panels as $panel) {
            $this->countLed += $panel->tiang->where('lampu', 'LED')->count();
            $this->countSont += $panel->tiang->where('lampu', 'SON-T')->count();
            $this->countBohlam += $panel->tiang->where('lampu', 'Bohlam')->count();
        }
    }

}
