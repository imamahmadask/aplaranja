<?php

namespace App\Livewire\Admin\Jalan;

use App\Models\Jalan;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Create Jalan')]
class CreateJalan extends Component
{
    #[Validate('required')]
    public $kode, $nama, $panjang, $lebar, $kordinat, $is_survey, $status;

    public $lat, $long, $ket;

    public function render()
    {
        return view('livewire.admin.jalan.create-jalan');
    }

    public function addJalan()
    {
        $this->validate();

        $this->getKordinat($this->kordinat);

        Jalan::create([
            'kode' => $this->kode,
            'nama' => $this->nama,
            'panjang' => $this->panjang,
            'lebar' => $this->lebar,
            'lat' => $this->lat,
            'long' => $this->long,
            'is_survey' => $this->is_survey,
            'ket' => $this->ket,
            'status' => $this->status
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
