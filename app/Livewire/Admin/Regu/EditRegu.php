<?php

namespace App\Livewire\Admin\Regu;

use App\Models\Regu;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Edit Jalan')]
class EditRegu extends Component
{
    #[Validate('required')]
    public $reguId, $kode, $nama, $jml_anggota;

    public function render()
    {
        return view('livewire.admin.regu.edit-regu');
    }

    public function mount($id)
    {
        $regu = Regu::find($id);

        $this->reguId = $regu->id;
        $this->kode = $regu->kode;
        $this->nama = $regu->nama;
        $this->jml_anggota = $regu->jml_anggota;
    }

    public function updateRegu()
    {
        $this->validate();

        $regu = Regu::find($this->reguId);

        $regu->update([
            'kode' => $this->kode,
            'nama' => $this->nama,
            'jml_anggota' => $this->jml_anggota,
        ]);

        $this->reset();

        $this->redirect('/admin/regu');
    }
}
