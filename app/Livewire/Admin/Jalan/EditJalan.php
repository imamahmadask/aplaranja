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
    }

    public function updateJalan()
    {
        $this->validate();

        $jalan = Jalan::find($this->jalanId);

        $jalan->update([
            'kode' => $this->kode,
            'nama' => $this->nama,
            'panjang' => $this->panjang,
            'lebar' => $this->lebar,
        ]);

        $this->reset();

        $this->redirect('/admin/jalan');
    }
}
