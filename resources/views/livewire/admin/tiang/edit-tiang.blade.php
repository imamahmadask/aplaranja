<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Tiang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tiang.index') }}">Tiang</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                            <h3 class="card-title">Form Edit Tiang</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form wire:submit="updateTiang">
                            <input type="hidden" name="" wire:model="tiangId">
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
                                </div>

                                <div class="form-group">
                                    <label for="kode">Kode</label>
                                    <input type="text" wire:model="kode" class="form-control" id="kode"
                                        placeholder="Masukkan Kode Tiang">
                                </div>

                                <div class="form-group">
                                    <label for="kategori">Kategori Tiang</label>
                                    <select name="kategori" wire:model="kategori" class="form-control">
                                        <option value="">Pilih kategori</option>
                                        <option value="Ornamen">Ornamen</option>
                                        <option value="Tiang">Tiang</option>
                                        <option value="Tiang Gawang">Tiang Gawang</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="jenis">Jenis Tiang</label>
                                    <select name="jenis" wire:model="jenis" class="form-control">
                                        <option value="">Pilih Jenis</option>
                                        <option value="Galpanis">Galpanis</option>
                                        <option value="Besi">Besi</option>
                                        <option value="Dekoratif">Dekoratif</option>
                                        <option value="-">Tidak ada</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="lengan">Jumlah Lengan</label>
                                    <select name="lengan" wire:model="lengan" class="form-control">
                                        <option value="">Pilih Lengan</option>
                                        <option value="1">1 Lengan</option>
                                        <option value="2">2 Lengan</option>
                                        <option value="3">3 Lengan</option>
                                        <option value="8">8 Lengan</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tahun_pengadaan">Tahun Pengadaan</label>
                                    <input type="number" wire:model="tahun_pengadaan" class="form-control"
                                        id="tahun_pengadaan" placeholder="Masukkan Tahun">
                                </div>

                                <div class="form-group">
                                    <label for="jaringan">Jenis Jaringan</label>
                                    <select name="jaringan" wire:model="jaringan" class="form-control">
                                        <option value="">Pilih Jenis Jaringan</option>
                                        <option value="Atas">Atas</option>
                                        <option value="Bawah">Bawah</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="posisi_tiang">Posisi Tiang</label>
                                    <select name="posisi_tiang" wire:model="posisi_tiang" class="form-control">
                                        <option value="">Pilih Posisi Tiang</option>
                                        <option value="Bahu Jalan">Bahu Jalan</option>
                                        <option value="Median">Median</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kordinat">Kordinat</label>
                                    <input type="text" wire:model="kordinat" class="form-control" id="kordinat"
                                        placeholder="Masukkan Kordinat">
                                </div>

                                <div class="form-group">
                                    <label for="lampu">Jenis Lampu</label>
                                    <select name="lampu" wire:model="lampu" class="form-control">
                                        <option value="">Pilih Jenis Lampu</option>
                                        <option value="LED">LED</option>
                                        <option value="Son-T">Son-T</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kondisi">Kondisi Tiang</label>
                                    <select name="kondisi" wire:model="kondisi" class="form-control">
                                        <option value="">Pilih Kondisi</option>
                                        <option value="Normal">Normal</option>
                                        <option value="Rusak Ringan">Rusak Ringan</option>
                                        <option value="Rusak Sedang">Rusak Sedang</option>
                                        <option value="Rusak Berat">Rusak Berat</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" wire:model="foto" class="form-control" id="foto">

                                    @if ($foto)
                                        @if ($foto->extension() != 'pdf')
                                            <img src="{{ $foto->temporaryUrl() }}" width="200px" class="mt-2">
                                        @endif
                                    @else
                                        <img src="/storage/{{ $foto_asli }}" class="mt-2" width="200px">
                                    @endif
                                    @error('foto')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Edit</button>
                                <a type="button" href="/admin/tiang" class="btn btn-danger">Cancel</a>
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
