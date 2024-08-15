<?php

namespace App\Livewire\Admin\Jalan;

use App\Models\Jalan;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Edit Jalan')]
class EditJalan extends Component
{
    #[Validate('required')]
    public $jalanId, $kode, $nama, $panjang, $lebar;

    public $kordinat, $lat, $long;

    public function render()
    {
        return view('livewire.admin.jalan.edit-jalan');
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
    }

    public function updateJalan()
    {
        $this->validate();

        $jalan = Jalan::find($this->jalanId);

        $this->getKordinat($this->kordinat);

        $jalan->update([
            'kode' => $this->kode,
            'nama' => $this->nama,
            'panjang' => $this->panjang,
            'lebar' => $this->lebar,
            'lat' => $this->lat,
            'long' => $this->long,
        ]);

        $this->reset();

        $this->redirect('/admin/jalan');
    }

    public function getKordinat($value){
        $pecah = explode(", ", $value);
        $this->lat = $pecah[0];
        $this->long = $pecah[1];
    }

}
