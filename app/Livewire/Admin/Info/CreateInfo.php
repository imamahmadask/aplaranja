<?php

namespace App\Livewire\Admin\Info;

use App\Models\InfoUmum;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Create Info Umum')]
class CreateInfo extends Component
{
    use WithFileUploads;

    #[Validate('required')]
    public $nama, $deskripsi;

    #[Validate('image|max:2000')]
    public $gambar;

    public function render()
    {
        return view('livewire.admin.info.create-info');
    }

    public function addInfo()
    {
        $this->validate();

        // Gambar Lokasi
        $nama_gambar = $this->nama.'.'.$this->gambar->extension();
        $file_gambar = $this->gambar->storeAs('gambar_info', $nama_gambar, 'public');

        InfoUmum::create([
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
            'gambar' => $file_gambar,
        ]);

        $this->reset();

        $this->redirect('/admin/info');
    }
}
