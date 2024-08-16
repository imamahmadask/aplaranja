<?php

namespace App\Imports;

use App\Models\Panel;
use App\Models\Tiang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class TiangImport implements ToModel, WithHeadingRow, WithUpserts
{
    public function uniqueBy()
    {
        return 'kode';
    }

    public function model(array $row)
    {
        $panel_id = Panel::where('kode', $row['panel'])->value('id');
        $kode_panel = Panel::where('kode', $row['panel'])->value('kode');

        $pecah = explode(", ", $row['kordinat']);
        $lat = $pecah[0];
        $long = $pecah[1];

        return new Tiang([
            'kode'              => $kode_panel.'-'.$row['kode'],
            'kategori'          => $row['kategori'],
            'jenis'             => $row['jenis'],
            'lengan'            => $row['lengan'],
            'tahun_pengadaan'   => $row['tahun_pengadaan'],
            'jaringan'          => $row['jaringan'],
            'posisi_tiang'      => $row['posisi_tiang'],
            'lat'               => $long,
            'long'              => $lat,
            'lampu'             => $row['lampu'],
            'panel_id'          => $panel_id,
        ]);
    }
}
