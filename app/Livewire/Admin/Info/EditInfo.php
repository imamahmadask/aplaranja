<?php

namespace App\Livewire\Admin\Info;

use App\Models\InfoUmum;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Edit Info Umum')]
class EditInfo extends Component
{
    use WithFileUploads;

    #[Validate('required')]
    public $infoUmumId, $nama, $deskripsi;

    #[Validate('image|max:2000')]
    public $gambar;

    public $gambar_asli;

    public function render()
    {
        return view('livewire.admin.info.edit-info');
    }

    public function mount($id)
    {
        $info = InfoUmum::find($id);

        $this->infoUmumId = $info->id;
        $this->nama = $info->nama;
        $this->deskripsi = $info->deskripsi;
        $this->gambar_asli = $info->gambar;
    }

    public function updateInfo()
    {
        $this->validate();

        $info = InfoUmum::find($this->infoUmumId);

         // setting Gambar Lokasi
        if($this->gambar == $info->gambar || $this->gambar == null){
            $file_gambar = $info->gambar;
        }else{
            $nama_gambar = $this->nama.'.'.$this->gambar->extension();
            $file_gambar = $this->gambar->storeAs('gambar_info', $nama_gambar, 'public');
        }

         $info->update([
             'nama' => $this->nama,
             'deskripsi' => $this->deskripsi,
             'gambar' => $file_gambar,
         ]);

        $this->reset();

        $this->redirect('/admin/info');
    }
}
