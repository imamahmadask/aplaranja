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

    public $search_tiang ='';
    public $perPage = 5;

    public function render()
    {
        $stat = [
            'count_jalan' => Jalan::count(),
            'count_panel' => Panel::count(),
            'count_tiang' => Tiang::count(),
            'count_regu' => Regu::count(),
        ];

        $jalans = Jalan::with('panel.tiang')
            ->withCount('panel')
            ->get();

        $jalans->each(function($jalan) {
            $jalan->tiang_count = $jalan->panel->sum(function($panel) {
                return $panel->tiang->count();
            });
        });

        return view('livewire.admin.dashboard.index-dashboard', [
            'stat' => $stat,
            'jalans' => $jalans
        ]);
    }

    #[Computed()]
    public function jalans()
    {
        return DB::table('jalans')
            ->select(DB::raw('
                jalans.nama as jalan,
                jalans.kode as kode_jalan,
                count(DISTINCT panels.id) as jml_panel,
                count(tiangs.id) as jml_tiang,
                SUM(CASE WHEN tiangs.jenis = "galpanis" THEN 1 ELSE 0 END) as jml_tiang_galpanis,
                SUM(CASE WHEN tiangs.jenis = "besi" THEN 1 ELSE 0 END) as jml_tiang_besi,
                SUM(CASE WHEN tiangs.jenis = "dekoratif" THEN 1 ELSE 0 END) as jml_tiang_dekor
            '))
            ->leftJoin('panels', 'jalans.id', '=', 'panels.jalan_id')
            ->leftJoin('tiangs', 'panels.id', '=', 'tiangs.panel_id')
            ->where('nama', 'like', '%'.$this->search_tiang.'%')
            ->groupBy('jalans.nama', 'jalans.kode', 'jalans.lat', 'jalans.long')
            ->paginate($this->perPage);
    }

    #[Computed()]
    public function total_jalans()
    {
        return DB::table('jalans')
        ->select(DB::raw('
            count(DISTINCT jalans.id) as total_jalan,
            count(DISTINCT panels.id) as total_panel,
            count(tiangs.id) as total_tiang,
            SUM(CASE WHEN tiangs.jenis = "galpanis" THEN 1 ELSE 0 END) as total_tiang_galpanis,
            SUM(CASE WHEN tiangs.jenis = "besi" THEN 1 ELSE 0 END) as total_tiang_besi,
            SUM(CASE WHEN tiangs.jenis = "dekoratif" THEN 1 ELSE 0 END) as total_tiang_dekor
        '))
        ->leftJoin('panels', 'jalans.id', '=', 'panels.jalan_id')
        ->leftJoin('tiangs', 'panels.id', '=', 'tiangs.panel_id')
        ->where('jalans.nama', 'like', '%'.$this->search_tiang.'%')
        ->first();
    }

}
