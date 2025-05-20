<?php

namespace App\Imports;

use App\Models\Jalan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JalanUpdate implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Jalan::where('kode', $row['kode'])->update([
                'status' => $row['status'],
            ]);
        }
    }
}
