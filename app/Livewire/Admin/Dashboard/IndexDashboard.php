<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Jalan;
use App\Models\Lampu;
use App\Models\Panel;
use App\Models\Regu;
use App\Models\Tiang;
use Illuminate\Support\Facades\DB;
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
            'count_regu' => Regu::count(),
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
        return DB::table('tiangs')
            ->select(DB::raw('
                jalans.nama as jalan,
                jalans.kode as kode_jalan,
                count(DISTINCT panels.id) as jml_panel,
                count(tiangs.id) as jml_tiang,
                SUM(CASE WHEN tiangs.jenis = "galpanis" THEN 1 ELSE 0 END) as jml_tiang_galpanis,
                SUM(CASE WHEN tiangs.jenis = "besi" THEN 1 ELSE 0 END) as jml_tiang_besi,
                SUM(CASE WHEN tiangs.jenis = "dekoratif" THEN 1 ELSE 0 END) as jml_tiang_dekor
            '))
            ->join('panels', 'panels.id', '=', 'tiangs.panel_id')
            ->join('jalans', 'jalans.id', '=', 'panels.jalan_id')
            ->groupBy('jalans.nama')
            ->groupBy('jalans.kode')
            ->paginate($this->perPage);
    }

}
