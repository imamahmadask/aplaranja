<?php

namespace App\Livewire\Admin\Tiang;

use App\Models\Panel;
use App\Models\Tiang;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Edit Tiang')]
class EditTiang extends Component
{
    use WithFileUploads;

    #[Validate('required')]
    public $tiangId, $kode, $kategori, $jenis, $lengan, $tahun_pengadaan, $jaringan, $kordinat, $panel_id, $lampu, $posisi_tiang;

    public $panels, $lat, $long, $kode_panel, $kondisi;

    // #[Validate('image|max:2000')]
    public $foto;

    public $foto_asli;

    public array $lights = [];

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
        $this->kondisi = $tiang->kondisi;
        $this->foto_asli = $tiang->foto;

        $this->lights = $tiang->lampus->map(function ($lampu) {
            return $lampu->toArray(); // Konversi ke array untuk editing
        })->toArray();

        // Jika jumlah lampu kurang dari lengan (karena sebelumnya belum sinkron), tambahkan kosong
        $this->syncLightsWithLengan();

        $this->panels = Panel::orderBy('kode', 'asc')->get();
    }

    public function updateTiang()
    {
        $this->validate();

        $tiang = Tiang::find($this->tiangId);

        $this->getKordinat($this->kordinat);

        // setting Gambar Lokasi
        if($this->foto == $tiang->foto || $this->foto == null){
            $file_foto = $tiang->foto;
        }else{
            $nama_foto = $this->kode.'.'.$this->foto->extension();
            $file_foto = $this->foto->storeAs('gambar_tiang', $nama_foto, 'public');
        }

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
            'kondisi' => $this->kondisi,
            'foto' => $file_foto,
        ]);

        // === UPDATE DATA LAMPU ===
        // Hapus semua lampu lama
        $tiang->lampus()->delete();

        // Buat ulang sesuai data di form
        if ($this->lengan > 0) {
            foreach ($this->lights as $light) {
                $tiang->lampus()->create([
                    'jenis' => $light['jenis'] ?? 'Tidak Ada',
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

    /**
     * Otomatis menyesuaikan jumlah item di $lights sesuai $lengan
     */
    public function updatedLengan($value)
    {
        $value = (int) $value;
        $this->lengan = $value;

        $this->syncLightsWithLengan();
        $this->resetValidation('lights'); // Hapus error validasi lama
    }

    private function syncLightsWithLengan()
    {
        $currentCount = count($this->lights);
        $targetCount = $this->lengan;

        if ($targetCount > $currentCount) {
            // Tambah lampu kosong
            for ($i = $currentCount; $i < $targetCount; $i++) {
                $this->lights[] = [
                    'jenis' => '',
                    'daya' => '',
                    'lumen' => '',
                    'kondisi' => '5',
                ];
            }
        } elseif ($targetCount < $currentCount) {
            // Potong lampu yang kelebihan (akan dihapus di DB saat simpan)
            $this->lights = array_slice($this->lights, 0, $targetCount);
        }
        // Jika sama → tidak ada perubahan
    }
}
