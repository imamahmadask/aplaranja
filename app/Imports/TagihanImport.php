<?php

namespace App\Imports;

use App\Models\Panel;
use App\Models\Tagihan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class TagihanImport implements ToModel, WithHeadingRow, WithUpserts, WithCustomCsvSettings, WithCalculatedFormulas
{
    protected $delimiter;
    protected $headingRowIndex;

    public function __construct($delimiter = ',', $headingRowIndex = 1)
    {
        $this->delimiter = $delimiter;
        $this->headingRowIndex = $headingRowIndex;
    }

    public function headingRow(): int
    {
        return $this->headingRowIndex;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => $this->delimiter,
        ];
    }

    public function uniqueBy()
    {
        return ['idpel', 'blth'];
    }

    public function model(array $row)
    {
        // Bersihkan key array agar robust terhadap spasi tersembunyi atau simbol aneh
        $cleanedRow = [];
        foreach ($row as $key => $value) {
            $cleanedKey = strtolower(trim(preg_replace('/[^A-Za-z0-9_]/', '', $key)));
            $cleanedRow[$cleanedKey] = $value;
        }

        $idpel = isset($cleanedRow['idpel']) ? trim($cleanedRow['idpel']) : null;
        if (empty($idpel) || strtolower($idpel) === 'idpel') {
            return null;
        }

        $panel = Panel::where('idpel', $idpel)->first();
        $panel_id = $panel ? $panel->id : null;

        $blth = isset($cleanedRow['blth']) ? trim($cleanedRow['blth']) : '';
        $bulan = 0;
        $tahun = 0;

        if (strlen($blth) == 6) {
            $tahun = (int) substr($blth, 0, 4);
            $bulan = (int) substr($blth, 4, 2);
        }

        $daya = isset($cleanedRow['daya']) ? (int) $cleanedRow['daya'] : null;
        $pemkwh = isset($cleanedRow['pemkwh']) ? (int) $cleanedRow['pemkwh'] : 0;

        $rptag = $this->parseAmount($cleanedRow['rptag'] ?? 0);
        $materai = $this->parseAmount($cleanedRow['materai'] ?? 0);
        
        $adminRaw = $cleanedRow['admintagihan'] ?? $cleanedRow['admin_tagihan'] ?? $cleanedRow['admin'] ?? 0;
        $admin = $this->parseAmount($adminRaw);

        $total = $this->parseAmount($cleanedRow['total'] ?? 0);

        return new Tagihan([
            'panel_id' => $panel_id,
            'idpel'    => $idpel,
            'nama'     => $cleanedRow['nama'] ?? null,
            'alamat'   => $cleanedRow['alamat'] ?? null,
            'tarif'    => $cleanedRow['tarip'] ?? $cleanedRow['tarif'] ?? null,
            'daya'     => $daya,
            'blth'     => $blth,
            'bulan'    => $bulan,
            'tahun'    => $tahun,
            'pemkwh'   => $pemkwh,
            'rptag'    => $rptag,
            'materai'  => $materai,
            'admin'    => $admin,
            'total'    => $total,
        ]);
    }

    private function parseAmount($value)
    {
        if (is_numeric($value)) {
            return (float) $value;
        }

        $clean = str_replace([' ', 'Rp', 'rp'], '', $value);
        $clean = preg_replace('/[\.,]00$/', '', $clean);
        $cleanVal = preg_replace('/[^0-9\-]/', '', $clean);
        return empty($cleanVal) ? 0.00 : (float) $cleanVal;
    }
}
