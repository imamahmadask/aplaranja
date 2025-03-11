<?php

namespace App\Http\Controllers;

use App\Models\Jalan;
use App\Models\Panel;
use App\Models\Regu;
use App\Models\Tiang;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $count_jalan = Jalan::count();
        $count_tiang = Tiang::count();
        $count_panel = Panel::count();
        $count_regu = Regu::count();
        $data = [
            'count_jalan' => $count_jalan,
            'count_tiang' => $count_tiang,
            'count_panel' => $count_panel,
            'count_regu' => $count_regu,
        ];
        return view('welcome', [
            'data' => $data
        ]);
    }
    public function show($kode)
    {

        $tiang = Tiang::where('kode', $kode)->firstOrFail();

        return view('details', compact('tiang'));
    }
}
