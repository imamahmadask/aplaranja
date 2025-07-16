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

    public $search_jalan ='';
    public $perPage = 10;

    public function render()
    {
        $stat = [
            'count_jalan' => Jalan::count(),
            'count_panel' => Panel::count(),
            'count_tiang' => Tiang::count(),
            'count_regu' => Regu::count(),
        ];

        $jalans = Jalan::with(['panel.tiang'])
        ->withCount('panel')
        ->get();

        $jalans->each(function($jalan) {
            $jalan->jml_tiang = $jalan->panel->sum(function($panel) {
                return $panel->tiang->count();
            });
            $jalan->lampu_count = $jalan->panel->sum(function($panel) {
                return $panel->tiang->sum('lengan');
            });
        });

        // Count roads by status
        $jalan_status = [
            'nasional' => $jalans->where('status', 'Nasional')->count(),
            'provinsi' => $jalans->where('status', 'Provinsi')->count(),
            'kota' => $jalans->where('status', 'Kota')->count(),
            'lingkungan' => $jalans->where('status', 'Lingkungan')->count(),
        ];

        // Count poles by category
        $tiang_kategori = [
            'tunggal' => $jalans->sum(function($jalan) {
                return $jalan->panel->sum(function($panel) {
                    return $panel->tiang->where('kategori', 'Tiang')->count();
                });
            }),
            'ornamen' => $jalans->sum(function($jalan) {
                return $jalan->panel->sum(function($panel) {
                    return $panel->tiang->where('kategori', 'Ornamen')->count();
                });
            }),
            'gawang' => $jalans->sum(function($jalan) {
                return $jalan->panel->sum(function($panel) {
                    return $panel->tiang->where('kategori', 'Gawang')->count();
                });
            }),
        ];

        // Count lamps by type
        $lampu_jenis = [
            'led' => $jalans->sum(function($jalan) {
                return $jalan->panel->sum(function($panel) {
                    return $panel->tiang->where('lampu', 'LED')->count();
                });
            }),
            'sont' => $jalans->sum(function($jalan) {
                return $jalan->panel->sum(function($panel) {
                    return $panel->tiang->where('lampu', 'SON-T')->count();
                });
            }),
            'bohlam' => $jalans->sum(function($jalan) {
                return $jalan->panel->sum(function($panel) {
                    return $panel->tiang->where('lampu', 'BOHLAM')->count();
                });
            }),
            'solar' => $jalans->sum(function($jalan) {
                return $jalan->panel->sum(function($panel) {
                    return $panel->tiang->where('lampu', 'Solar Cell')->count();
                });
            }),
        ];

        // Add status counts to stats array
        $stat = array_merge($stat, $jalan_status, $tiang_kategori, $lampu_jenis);

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
                jalans.id as id_jalan,
                jalans.nama as jalan,
                jalans.kode as kode_jalan,
                jalans.is_survey as is_survey,
                jalans.status as status,
                count(DISTINCT panels.id) as jml_panel,
                count(tiangs.id) as jml_tiang,
                SUM(CASE WHEN tiangs.lengan = 1 THEN 1 ELSE 0 END) as jml_1_lengan,
                SUM(CASE WHEN tiangs.lengan = 2 THEN 1 ELSE 0 END) as jml_2_lengan,
                SUM(CASE WHEN tiangs.lengan = 3 THEN 1 ELSE 0 END) as jml_3_lengan,
                SUM(CASE WHEN tiangs.lengan > 3 THEN 1 ELSE 0 END) as jml_lebih_lengan,
                SUM(tiangs.lengan) as total_lampu
            '))
            ->leftJoin('panels', 'jalans.id', '=', 'panels.jalan_id')
            ->leftJoin('tiangs', 'panels.id', '=', 'tiangs.panel_id')
            ->where('jalans.nama', 'like', '%'.$this->search_jalan.'%')
            ->orWhere('jalans.kode', 'like', '%'.$this->search_jalan.'%')
            ->orderBy('jalans.kode', 'asc')
            ->groupBy('jalans.id', 'jalans.nama', 'jalans.kode', 'jalans.lat', 'jalans.long', 'jalans.is_survey')
            ->paginate($this->perPage);
    }

    #[Computed()]
    public function total_jalans()
    {
        return DB::table('jalans')
                    ->select(DB::raw('
                        COUNT(DISTINCT jalans.id) as total_jalan,
                        COUNT(DISTINCT panels.id) as total_panel,
                        COUNT(tiangs.id) as total_tiang,
                        COUNT(DISTINCT CASE WHEN jalans.is_survey = 1 THEN jalans.id ELSE NULL END) as total_is_survey,
                        SUM(CASE WHEN tiangs.lengan = 1 THEN 1 ELSE 0 END) as total_1_lengan,
                        SUM(CASE WHEN tiangs.lengan = 2 THEN 1 ELSE 0 END) as total_2_lengan,
                        SUM(CASE WHEN tiangs.lengan = 3 THEN 1 ELSE 0 END) as total_3_lengan,
                        SUM(CASE WHEN tiangs.lengan > 3 THEN 1 ELSE 0 END) as total_lebih_lengan,
                        SUM(tiangs.lengan) as total_lampu
                    '))
                    ->leftJoin('panels', 'jalans.id', '=', 'panels.jalan_id')
                    ->leftJoin('tiangs', 'panels.id', '=', 'tiangs.panel_id')
                    ->where('jalans.nama', 'like', '%'.$this->search_jalan.'%')
                    ->orWhere('jalans.kode', 'like', '%'.$this->search_jalan.'%')
                    ->first();
    }

}
