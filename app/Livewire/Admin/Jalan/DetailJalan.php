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
    public $jalanId, $kode, $nama, $panjang, $lebar, $kordinat, $is_survey, $ket, $status;
    public int $countPanels = 0;
    public int $countTiangs = 0;
    public int $countTiang = 0;
    public int $countOrnamen = 0;
    public int $countGawang = 0;
    public int $countBesi = 0;
    public int $countGalvanis = 0;
    public int $countDekoratif = 0;
    public int $countLed = 0;
    public int $countSont = 0;
    public int $countBohlam = 0;
    public int $countSolarCell = 0;
    public int $totalLampu = 0;
    public int $count1Lengan = 0;
    public int $count2Lengan = 0;
    public int $count2MoreLengan = 0;
    public int $totalLengan = 0;
    public int $countNormal = 0;
    public int $countRusakRingan = 0;
    public int $countRusakSedang = 0;
    public int $countRusakBerat = 0;
    public $kordinat_tiang = [];

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
        $this->status = $jalan->status;

        $detail = Jalan::where('id', $this->jalanId)->withCount(['panel', 'tiang'])->get();

        $tiang = $jalan->tiang()->get();
        foreach ($tiang as $t) {
            $this->kordinat_tiang[] = [
                'id' => $t->id,
                'lat' => $t->lat,
                'long' => $t->long,
                'jenis' => $t->jenis,
                'posisi' => $t->posisi_tiang,
                'kode' => $t->kode,
                'lengan' => $t->lengan,
                'lampu' => $t->lampu,
                'kategori' => $t->kategori
            ];
        }

        $this->countPanels = $detail[0]->panel_count;
        $this->countTiangs = $detail[0]->tiang_count;
        $this->countJenisTiang();
        $this->countKategoriTiang();
        $this->countLengan();
        $this->countLampuByJenisAndLengan();
        $this->countKondisiTiang();
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
            $this->countDekoratif += $panel->tiang->where('jenis', 'Dekoratif')->count();
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

    public function countLengan()
    {
        $panels = Panel::where('jalan_id', $this->jalanId)->get();
        foreach ($panels as $panel) {
            $this->count1Lengan += $panel->tiang->where('lengan', 1)->count();
            $this->count2Lengan += $panel->tiang->where('lengan', 2)->count();
            $this->count2MoreLengan += $panel->tiang->where('lengan', '>', 2)->count();
        }
    }

    public function countLampuByJenisAndLengan()
    {
        // Ambil data tiang dengan relasi panel
        $panels = Panel::where('jalan_id', $this->jalanId)->with('tiang')->get();

        foreach ($panels as $panel) {
            foreach ($panel->tiang as $tiang) {
                $jenisLampu = $tiang->lampu;
                $jumlahLengan = $tiang->lengan ?? 1; // Default lengan = 1 jika null

                // Hitung jumlah lampu sesuai jenis
                if ($jenisLampu === 'LED') {
                    $this->countLed += $jumlahLengan;
                } elseif ($jenisLampu === 'SON-T') {
                    $this->countSont += $jumlahLengan;
                } elseif ($jenisLampu === 'BOHLAM') {
                    $this->countBohlam += $jumlahLengan;
                } elseif ($jenisLampu === 'Solar Cell') {
                    $this->countSolarCell += $jumlahLengan;
                }
            }
        }
        $this->totalLampu = $this->countLed + $this->countSont + $this->countBohlam + $this->countSolarCell;
        $this->totalLengan = $this->totalLampu;

    }

    public function countKondisiTiang()
    {
        $panels = Panel::where('jalan_id', $this->jalanId)->get();
        foreach ($panels as $panel) {
            $this->countNormal += $panel->tiang->where('kondisi', 'Normal')->count();
            $this->countRusakRingan += $panel->tiang->where('kondisi', 'Rusak Ringan')->count();
            $this->countRusakSedang += $panel->tiang->where('kondisi', 'Rusak Sedang')->count();
            $this->countRusakBerat += $panel->tiang->where('kondisi', 'Rusak Berat')->count();
        }
    }

}
