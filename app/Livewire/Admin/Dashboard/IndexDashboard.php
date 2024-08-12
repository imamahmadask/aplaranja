<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Jalan;
use App\Models\Lampu;
use App\Models\Panel;
use App\Models\Tiang;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Title('Dashboard')]
class IndexDashboard extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search ='';
    public $perPage = 10;

    public function render()
    {
        $stat = [
            'count_jalan' => Jalan::count(),
            'count_panel' => Panel::count(),
            'count_tiang' => Tiang::count(),
            'count_lampu' => Lampu::count(),
        ];

        $tiangs = Tiang::all();

        return view('livewire.admin.dashboard.index-dashboard', [
            'stat' => $stat,
            'tiangs' => $tiangs
        ]);
    }

    #[Computed()]
    public function tiangs()
    {
        return Tiang::paginate($this->perPage);
    }

}
