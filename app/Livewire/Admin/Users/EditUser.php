<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
#[Title('Edit User')]
class EditUser extends Component
{
    #[Validate('required')]
    public $name, $email, $role;

    public $userId;
    public function render()
    {
        return view('livewire.admin.users.edit-user');
    }

    public function mount($id)
    {
        $user = User::find($id);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
    }

    public function updateUser()
    {
        $this->validate();

        $user = User::find($this->userId);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role
        ]);

        $this->reset();

        $this->redirect('/admin/users');
    }
}
