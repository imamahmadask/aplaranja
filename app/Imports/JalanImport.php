<?php

namespace App\Imports;

use App\Models\Jalan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class JalanImport implements ToModel, WithHeadingRow, WithUpserts
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
        return new Jalan([
            'kode'     => $row['kode'],
            'nama'    => $row['nama'],
            'panjang' => $row['panjang'],
            'lebar' => $row['lebar'],
        ]);
    }
}
