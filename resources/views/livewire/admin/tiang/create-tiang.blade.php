<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Tiang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tiang.index') }}">Tiang</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Panel</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form wire:submit="addTiang">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="panel">Panel</label>
                                    <select name="panel_id" wire:model.live="panel_id" class="form-control">
                                        <option value="">Pilih Panel</option>
                                        @foreach ($panels as $panel)
                                            <option value={{ $panel->id }}>{{ $panel->kode }} -
                                                {{ $panel->jalan->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('panel_id')
                                        <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kode">Kode</label>
                                    <input type="text" wire:model="kode" class="form-control" id="kode"
                                        placeholder="Masukkan Kode Tiang">
                                    @error('kode')
                                        <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kategori">Kategori Tiang</label>
                                    <select name="kategori" wire:model="kategori" class="form-control">
                                        <option value="">Pilih kategori</option>
                                        <option value="Ornamen">Ornamen</option>
                                        <option value="Tiang">Tiang</option>
                                        <option value="Tiang Gawang">Tiang Gawang</option>
                                    </select>
                                    @error('kategori')
                                        <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jenis">Jenis Tiang</label>
                                    <select name="jenis" wire:model="jenis" class="form-control">
                                        <option value="">Pilih Jenis</option>
                                        <option value="Galvanis">Galvanis</option>
                                        <option value="Besi">Besi</option>
                                        <option value="Dekoratif">Dekoratif</option>
                                        <option value="-">Tidak ada</option>
                                    </select>
                                    @error('jenis')
                                        <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tahun_pengadaan">Tahun Pengadaan</label>
                                    <input type="number" wire:model="tahun_pengadaan" class="form-control"
                                        id="tahun_pengadaan" placeholder="Masukkan Tahun">
                                    @error('tahun_pengadaan')
                                        <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jaringan">Jenis Jaringan</label>
                                    <select name="jaringan" wire:model="jaringan" class="form-control">
                                        <option value="">Pilih Jenis Jaringan</option>
                                        <option value="Atas">Atas</option>
                                        <option value="Bawah">Bawah</option>
                                    </select>
                                    @error('jaringan')
                                        <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="posisi_tiang">Posisi Tiang</label>
                                    <select name="posisi_tiang" wire:model="posisi_tiang" class="form-control">
                                        <option value="">Pilih Posisi Tiang</option>
                                        <option value="Bahu jalan">Bahu Jalan</option>
                                        <option value="Median jalan">Median</option>
                                    </select>
                                    @error('posisi_tiang')
                                        <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kordinat">Kordinat</label>
                                    <input type="text" wire:model="kordinat" class="form-control" id="kordinat"
                                        placeholder="Masukkan Kordinat">
                                    @error('kordinat')
                                        <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="lengan">Jumlah Lengan</label>
                                    <select name="lengan" wire:model.live="lengan" class="form-control">
                                        <option value="">Pilih Lengan</option>
                                        <option value="1">1 Lengan</option>
                                        <option value="2">2 Lengan</option>
                                        <option value="3">3 Lengan</option>
                                        <option value="8">8 Lengan</option>
                                        <option value="0">Tidak Ada</option>
                                    </select>
                                    @error('lengan')
                                        <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Form Lampu Dinamis -->
                                @if ($lengan > 0)
                                    <div class="border rounded p-4 bg-light mb-2">
                                        <h5>Data Lampu per Lengan</h5>
                                        <div class="row">
                                            @foreach ($lights as $index => $light)
                                                <div class="col-md-6 mb-4">
                                                    <div class="border p-3 rounded bg-white">
                                                        <h6 class="text-primary">Lengan {{ $index + 1 }}</h6>

                                                        <div class="form-group">
                                                            <label>Jenis Lampu</label>
                                                            <select wire:model.live="lights.{{ $index }}.jenis"
                                                                class="form-control">
                                                                <option value="">Pilih</option>
                                                                <option>LED</option>
                                                                <option>SON-T</option>
                                                                <option>BOHLAM</option>
                                                                <option>Sollar Cell</option>
                                                                <option>Tidak Ada</option>
                                                            </select>
                                                            @error("lights.$index.jenis")
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="number"
                                                                wire:model.live="lights.{{ $index }}.daya"
                                                                class="form-control" placeholder="Daya (Watt)">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="text"
                                                                wire:model.live="lights.{{ $index }}.merek"
                                                                class="form-control" placeholder="Merek">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="number"
                                                                wire:model.live="lights.{{ $index }}.lumen"
                                                                class="form-control" placeholder="Lumen">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Kondisi</label>
                                                            <select
                                                                wire:model.live="lights.{{ $index }}.kondisi"
                                                                class="form-control">
                                                                <option value="5">Sangat Baik</option>
                                                                <option value="4">Baik</option>
                                                                <option value="3">Cukup</option>
                                                                <option value="2">Buruk</option>
                                                                <option value="1">Sangat Buruk</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if ($lengan != 0)
                                    <div class="form-group">
                                        <label for="lampu">Jenis Lampu (lama)</label>
                                        <select name="lampu" wire:model="lampu" class="form-control">
                                            <option value="">Pilih Jenis Lampu</option>
                                            <option value="LED">LED</option>
                                            <option value="SON-T">SON-T</option>
                                            <option value="BOHLAM">BOHLAM</option>
                                            <option value="Sollar Cell">Solar Cell</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                        @error('lampu')
                                            <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="kondisi">Kondisi Tiang</label>
                                    <select name="kondisi" wire:model="kondisi" class="form-control">
                                        <option value="">Pilih Kondisi</option>
                                        <option value="5">5 - Sangat Baik</option>
                                        <option value="4">4 - Baik</option>
                                        <option value="3">3 - Cukup Baik</option>
                                        <option value="2">2 - Buruk</option>
                                        <option value="1">1 - Sangat Buruk</option>
                                    </select>
                                    @error('kondisi')
                                        <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="foto">Foto Tiang</label>
                                    <input type="file" wire:model="foto" class="form-control" id="foto">
                                    @if ($foto)
                                        <img src="{{ $foto->temporaryUrl() }}" width="200px" class="mt-2">
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
