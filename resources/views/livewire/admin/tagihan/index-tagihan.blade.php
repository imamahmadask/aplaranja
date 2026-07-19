<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tagihan Listrik PJU</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Tagihan</li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'User')
                <div class="card card-primary">
                    @if (session()->has('message'))
                        <div class="alert alert-success text-center m-3">{{ session('message') }}</div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger text-center m-3">{{ session('error') }}</div>
                    @endif
                    <div class="row p-3">
                        <div class="col-md-6">
                            <h5 class="font-weight-bold mb-3"><i class="fas fa-file-excel mr-1"></i> Import Data Tagihan (CSV/Excel)</h5>
                            <form wire:submit.prevent="addTagihan">
                                <div class="form-group">
                                    <label for="fileTagihan" class="font-weight-bold">File Tagihan</label>
                                    <input type="file" class="form-control" wire:model="fileTagihan" id="fileTagihan" />
                                    <small class="form-text text-muted">Kolom wajib di template: IDPEL, NAMA, ALAMAT, TARIP, DAYA, BLTH, PEMKWH, RPTAG, MATERAI, ADMIN TAGIHAN, TOTAL</small>
                                </div>

                                @error('fileTagihan')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror

                                <div wire:loading wire:target="fileTagihan" wire:key="fileTagihan">
                                    <i class="fa fa-spinner fa-spin mt-2 ml-2"></i> Mengunggah file...
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary w-20 mt-2">
                                        <div wire:loading wire:target="addTagihan" wire:key="addTagihan">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </div> Import Data
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 border-left">
                            <h5 class="font-weight-bold mb-3"><i class="fas fa-trash-alt mr-1"></i> Hapus Tagihan per Bulan</h5>
                            <form wire:submit.prevent="deleteTagihanBulanan">
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for="deleteBulan" class="font-weight-bold">Pilih Bulan</label>
                                        <select wire:model="deleteBulan" id="deleteBulan" class="form-control">
                                            <option value="">-- Pilih Bulan --</option>
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="deleteTahun" class="font-weight-bold">Pilih Tahun</label>
                                        <select wire:model="deleteTahun" id="deleteTahun" class="form-control">
                                            <option value="">-- Pilih Tahun --</option>
                                            @forelse($availableYears as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @empty
                                                <option value="2026">2026</option>
                                                <option value="2025">2025</option>
                                                <option value="2024">2024</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <button type="submit" 
                                        wire:confirm="Apakah Anda yakin ingin menghapus seluruh data tagihan untuk periode bulan dan tahun terpilih?"
                                        class="btn btn-danger w-20">
                                        <i class="fas fa-trash"></i> Hapus Bulanan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Filter and Table Section -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Tagihan Per Panel</h3>
                        </div>
                        
                        <!-- Filter Bar -->
                        <div class="card-body border-bottom p-3">
                            <div class="row">
                                <div class="col-md-3 col-sm-6 mb-2">
                                    <label class="text-xs">Cari (IDPEL/Nama/Alamat)</label>
                                    <input type="text" wire:model.live="search" class="form-control form-control-sm" placeholder="Cari...">
                                </div>
                                <div class="col-md-3 col-sm-6 mb-2">
                                    <label class="text-xs">Filter Ruas Jalan</label>
                                    <select wire:model.live="filterJalan" class="form-control form-control-sm">
                                        <option value="">Semua Jalan</option>
                                        @foreach($jalans as $jalan)
                                            <option value="{{ $jalan->id }}">{{ $jalan->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-2">
                                    <label class="text-xs">Filter Bulan</label>
                                    <select wire:model.live="filterBulan" class="form-control form-control-sm">
                                        <option value="">Semua Bulan</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-2">
                                    <label class="text-xs">Filter Tahun</label>
                                    <select wire:model.live="filterTahun" class="form-control form-control-sm">
                                        <option value="">Semua Tahun</option>
                                        @foreach($availableYears as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>IDPEL</th>
                                        <th>Nama</th>
                                        <th>Jalan / Panel</th>
                                        <th>Tarif/Daya</th>
                                        <th>Periode (BLTH)</th>
                                        <th class="text-right">Pemakaian (KWh)</th>
                                        <th class="text-right">Rupiah Tagihan</th>
                                        <th class="text-right">Biaya Admin</th>
                                        <th class="text-right">Total Tagihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($this->tagihans as $tagihan)
                                        <tr wire:key="tagihan-{{ $tagihan->id }}">
                                            <td>
                                                <span class="font-weight-bold">{{ $tagihan->idpel }}</span>
                                            </td>
                                            <td>
                                                <div class="text-sm font-weight-bold">{{ $tagihan->nama }}</div>
                                                <small class="text-muted d-block">{{ $tagihan->alamat }}</small>
                                            </td>
                                            <td>
                                                @if($tagihan->panel)
                                                    <span class="badge badge-info">{{ $tagihan->panel->kode }}</span>
                                                    <small class="d-block text-muted">{{ $tagihan->panel->jalan->nama ?? '-' }}</small>
                                                @else
                                                    <span class="badge badge-warning">Panel tidak terdaftar</span>
                                                @endif
                                            </td>
                                            <td>{{ $tagihan->tarif }} / {{ number_format($tagihan->daya) }} VA</td>
                                            <td>
                                                <span class="badge badge-light">
                                                    {{ DateTime::createFromFormat('!m', $tagihan->bulan)->format('F') }} {{ $tagihan->tahun }}
                                                </span>
                                                <small class="d-block text-muted">BLTH: {{ $tagihan->blth }}</small>
                                            </td>
                                            <td class="text-right font-weight-bold">{{ number_format($tagihan->pemkwh) }} KWh</td>
                                            <td class="text-right">Rp {{ number_format($tagihan->rptag) }}</td>
                                            <td class="text-right">Rp {{ number_format($tagihan->admin) }}</td>
                                            <td class="text-right text-primary font-weight-bold">Rp {{ number_format($tagihan->total) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-4 text-muted">Tidak ada data tagihan yang sesuai.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mx-4 my-2">
                                {{ $this->tagihans->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
