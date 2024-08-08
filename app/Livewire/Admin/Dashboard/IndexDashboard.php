<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Jalan;
use App\Models\Lampu;
use App\Models\Panel;
use App\Models\Tiang;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
class IndexDashboard extends Component
{

    public $count_jalan, $count_panel, $count_tiang, $count_lampu;

    public function render()
    {
        $this->count_jalan = Jalan::count();
        $this->count_panel = Panel::count();
        $this->count_tiang = Tiang::count();
        $this->count_lampu = Lampu::count();

        return view('livewire.admin.dashboard.index-dashboard');
    }
}
