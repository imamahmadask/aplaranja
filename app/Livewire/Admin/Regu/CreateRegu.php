<?php

namespace App\Livewire\Admin\Regu;

use App\Models\Regu;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Create Regu')]
class CreateRegu extends Component
{
    #[Validate('required')]
    public $kode, $nama, $jml_anggota;

    public function render()
    {
        return view('livewire.admin.regu.create-regu');
    }

    public function addRegu()
    {
        $this->validate();

        Regu::create([
            'kode' => $this->kode,
            'nama' => $this->nama,
            'jml_anggota' => $this->jml_anggota,
        ]);

        $this->reset();

        $this->redirect('/admin/regu');
    }
}
