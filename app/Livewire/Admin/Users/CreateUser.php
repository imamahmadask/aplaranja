<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Tambah User')]
class CreateUser extends Component
{
    #[Validate('required')]
    public $name, $email, $role, $password;

    public function render()
    {
        return view('livewire.admin.users.create-user');
    }

    public function addUser()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => bcrypt($this->password),
        ]);

        $this->reset();

        $this->redirect('/admin/users');
    }

}
