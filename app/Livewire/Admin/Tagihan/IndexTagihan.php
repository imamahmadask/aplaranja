<?php

namespace App\Livewire\Admin\Tagihan;

use App\Imports\TagihanImport;
use App\Models\Jalan;
use App\Models\Tagihan;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

#[Title('Tagihan')]
class IndexTagihan extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $perPage = 25;
    public $search = '';
    public $filterJalan = '';
    public $filterBulan = '';
    public $filterTahun = '';

    #[Validate('required|file|max:5000|mimes:csv,xls,xlsx,txt')]
    public $fileTagihan;

    public $deleteBulan = '';
    public $deleteTahun = '';

    protected $updatesQueryString = [
        'search' => ['except' => ''],
        'filterJalan' => ['except' => ''],
        'filterBulan' => ['except' => ''],
        'filterTahun' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterJalan()
    {
        $this->resetPage();
    }

    public function updatingFilterBulan()
    {
        $this->resetPage();
    }

    public function updatingFilterTahun()
    {
        $this->resetPage();
    }

    public function render()
    {
        $jalans = Jalan::orderBy('nama', 'asc')->get();
        $availableYears = Tagihan::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        return view('livewire.admin.tagihan.index-tagihan', [
            'jalans' => $jalans,
            'availableYears' => $availableYears
        ]);
    }

    #[Computed()]
    public function tagihans()
    {
        $query = Tagihan::query()
            ->with(['panel.jalan']);

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('idpel', 'like', '%'.$this->search.'%')
                  ->orWhere('nama', 'like', '%'.$this->search.'%')
                  ->orWhere('alamat', 'like', '%'.$this->search.'%');
            });
        }

        if (!empty($this->filterJalan)) {
            $query->whereHas('panel', function($q) {
                $q->where('jalan_id', $this->filterJalan);
            });
        }

        if (!empty($this->filterBulan)) {
            $query->where('bulan', $this->filterBulan);
        }

        if (!empty($this->filterTahun)) {
            $query->where('tahun', $this->filterTahun);
        }

        return $query->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->orderBy('idpel', 'asc')
            ->paginate($this->perPage);
    }

    public function addTagihan()
    {
        $this->validate();

        $delimiter = ',';
        $path = $this->fileTagihan->getRealPath();
        $extension = $this->fileTagihan->getClientOriginalExtension();

        if (in_array(strtolower($extension), ['csv', 'txt'])) {
            $file = fopen($path, 'r');
            if ($file) {
                $firstLine = fgets($file);
                fclose($file);
                if ($firstLine !== false) {
                    $semicolons = substr_count($firstLine, ';');
                    $commas = substr_count($firstLine, ',');
                    if ($semicolons > $commas) {
                        $delimiter = ';';
                    }
                }
            }
        }

        $headingRow = 1;
        try {
            $reader = Excel::toArray(new \stdClass, $this->fileTagihan);
            if (count($reader) > 0 && count($reader[0]) > 0) {
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
            // Fallback ke 1
        }

        try {
            Excel::import(new TagihanImport($delimiter, $headingRow), $this->fileTagihan);
            session()->flash('message', 'Data tagihan berhasil di-import!');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }

        $this->reset('fileTagihan');
        return redirect()->route('tagihan.index');
    }

    public function deleteTagihanBulanan()
    {
        if (empty($this->deleteBulan) || empty($this->deleteTahun)) {
            session()->flash('error', 'Silakan pilih bulan dan tahun untuk menghapus data tagihan.');
            return;
        }

        try {
            $count = Tagihan::where('bulan', $this->deleteBulan)
                ->where('tahun', $this->deleteTahun)
                ->count();

            if ($count === 0) {
                session()->flash('error', "Tidak ada data tagihan pada periode terpilih.");
                return;
            }

            Tagihan::where('bulan', $this->deleteBulan)
                ->where('tahun', $this->deleteTahun)
                ->delete();

            session()->flash('message', "Berhasil menghapus {$count} data tagihan pada periode terpilih.");
            
            $this->reset(['deleteBulan', 'deleteTahun']);
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
