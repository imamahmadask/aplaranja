<?php

namespace App\Livewire\Admin\Jalan;

use App\Models\Jalan;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateJalan extends Component
{
    #[Validate('required')]
    public $kode, $nama, $panjang, $lebar;

    public function render()
    {
        return view('livewire.admin.jalan.create-jalan');
    }

    public function addJalan()
    {
        $this->validate();

        Jalan::create([
            'kode' => $this->kode,
            'nama' => $this->nama,
            'panjang' => $this->panjang,
            'lebar' => $this->lebar,
        ]);

        $this->reset();

        session()->flash('status', 'Data Jalan berhasil ditambah!');

        $this->redirect('/admin/jalan');
    }
}
