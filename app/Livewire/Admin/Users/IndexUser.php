<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Users')]
class IndexUser extends Component
{
    public function render()
    {
        return view('livewire.admin.users.index-user');
    }

    #[Computed()]
    public function users()
    {
        return User::all();
    }
}
