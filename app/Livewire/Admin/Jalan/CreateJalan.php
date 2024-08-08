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

        $this->redirect('/admin/jalan');
    }
}
