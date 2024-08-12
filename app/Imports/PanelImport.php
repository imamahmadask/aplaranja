<?php

namespace App\Imports;

use App\Models\Jalan;
use App\Models\Panel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class PanelImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function uniqueBy()
    {
        return 'kode';
    }

    public function model(array $row)
    {
        $jalan_id = Jalan::where('kode', $row['jalan'])->value('id');

        $pecah = explode(", ", $row['kordinat']);
        $lat = $pecah[0];
        $long = $pecah[1];

        return new Panel([
            'kode'      => $row['kode'],
            'kwh'       => $row['kwh'],
            'idpel'     => $row['idpel'],
            'jaringan'  => $row['jaringan'],
            'saklar'    => $row['saklar'],
            'lat'       => $lat,
            'long'      => $long,
            'jalan_id'  => $jalan_id,
        ]);
    }
}
