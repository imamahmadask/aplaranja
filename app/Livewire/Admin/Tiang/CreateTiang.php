<?php

namespace App\Livewire\Admin\Tiang;

use App\Models\Lampu;
use App\Models\Panel;
use App\Models\Tiang;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Create Tiang')]
class CreateTiang extends Component
{
    use WithFileUploads;

    #[Validate('required')]
    public $kode, $kategori, $jenis, $lengan, $tahun_pengadaan, $jaringan, $kordinat, $panel_id, $posisi_tiang;

    // #[Validate('image|max:2000')]
    public $foto;

    public $panels, $lat, $long, $kode_panel, $kondisi;

    public array $lights = [];

    public function render()
    {
        return view('livewire.admin.tiang.create-tiang');
    }

    public function addTiang()
    {
        $this->validate();

        $this->getKordinat($this->kordinat);

        // Gambar Lokasi
        if($this->foto != null){
            $nama_foto = $this->kode.'.'.$this->foto->extension();
            $file_foto = $this->foto->storeAs('gambar_tiang', $nama_foto, 'public');
        }
        else
        {
            $file_foto = null;
        }

        $tiang = Tiang::create([
            'kode' => $this->kode_panel.'-'.$this->kode,
            'kategori' => $this->kategori,
            'jenis' => $this->jenis,
            'lengan' => $this->lengan,
            'tahun_pengadaan' => $this->tahun_pengadaan,
            'jaringan' => $this->jaringan,
            'lat' => $this->lat,
            'long' => $this->long,
            'panel_id' => $this->panel_id,
            'lampu' => '-',
            'posisi_tiang' => $this->posisi_tiang,
            'foto' => $file_foto,
            'kondisi' => $this->kondisi,
        ]);

        if ($this->lengan > 0 && !empty($this->lights)) {
            foreach ($this->lights as $light) {
                // dd($light);
                $tiang->lampus()->create([
                    'jenis' => $light['jenis'],
                    'daya' => $light['daya'],
                    'lumen' => $light['lumen'],
                    'merek' => $light['merek'],
                    'kondisi' => $light['kondisi'],
                ]);
            }
        }

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

    public function updatedLengan($value)
    {
        $value = (int) $value;

        // Reset data lampu
        $this->lights = [];

        if ($value > 0 && $value <= 8) {
            // Buat array sebanyak lengan dengan nilai default
            $this->lights = array_fill(0, $value, [
                'jenis' => '',
                'daya' => '',
                'lumen' => '',
                'merek' => '',
                'kondisi' => '5',
            ]);
        }

        $this->resetValidation('lights');
    }
}
