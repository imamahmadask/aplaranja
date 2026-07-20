<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\TagihanImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TagihanImportController extends Controller
{
    /**
     * Handle import file tagihan melalui traditional form POST.
     * Pendekatan ini menghindari endpoint /livewire/upload-file
     * yang bermasalah di lingkungan cPanel / shared hosting.
     */
    public function import(Request $request)
    {
        $request->validate([
            'fileTagihan' => ['required', 'file', 'max:20480', 'extensions:csv,xls,xlsx,txt'],
        ]);

        $file      = $request->file('fileTagihan');
        $path      = $file->getRealPath();
        $extension = strtolower($file->getClientOriginalExtension());

        // Deteksi delimiter CSV/TXT
        $delimiter = ',';
        if (in_array($extension, ['csv', 'txt'])) {
            $handle = fopen($path, 'r');
            if ($handle) {
                $firstLine = fgets($handle);
                fclose($handle);
                if ($firstLine !== false) {
                    if (substr_count($firstLine, ';') > substr_count($firstLine, ',')) {
                        $delimiter = ';';
                    }
                }
            }
        }

        // Deteksi baris heading (cari baris yang mengandung kolom 'idpel')
        $headingRow = 1;
        try {
            $reader = Excel::toArray(new \stdClass, $file);
            if (!empty($reader[0])) {
                foreach ($reader[0] as $index => $row) {
                    foreach ($row as $cell) {
                        if (is_string($cell) && strtolower(trim($cell)) === 'idpel') {
                            $headingRow = $index + 1;
                            break 2;
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Fallback ke baris pertama
        }

        try {
            Excel::import(new TagihanImport($delimiter, $headingRow), $file);
            return redirect()->route('tagihan.index')
                ->with('message', 'Data tagihan berhasil di-import!');
        } catch (\Exception $e) {
            return redirect()->route('tagihan.index')
                ->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
}
