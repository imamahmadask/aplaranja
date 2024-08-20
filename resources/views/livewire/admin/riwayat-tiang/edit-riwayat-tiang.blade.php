<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Riwayat Tiang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('riwayatTiang.index') }}">Regu</a></li>
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
                            <h3 class="card-title">Form Edit Riwayat Tiang</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form wire:submit="updateRiwayatTiang">
                            <input type="hidden" name="" wire:model.live="riwayat_tiang_id">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tiang_id">Tiang</label>
                                    <select name="tiang_id" wire:model.live="tiang_id" class="form-control">
                                        <option value="">Pilih Tiang</option>
                                        @foreach ($tiangs as $tiang)
                                            <option value={{ $tiang->id }}>{{ $tiang->kode }}</option>
                                        @endforeach
                                    </select>
                                    @error('tiang_id')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="regu_id">Regu</label>
                                    <select name="regu_id" wire:model.live="regu_id" class="form-control">
                                        <option value="">Pilih Regu</option>
                                        @foreach ($regus as $regu)
                                            <option value={{ $regu->id }}>{{ $regu->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('regu_id')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" wire:model="tanggal" class="form-control" id="tanggal">
                                    @error('tanggal')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Jenis</label>
                                    <input type="text" wire:model="jenis" class="form-control" id="jenis"
                                        placeholder="Masukkan Jenis">
                                    @error('jenis')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kerusakan">Kerusakan</label>
                                    <input type="text" wire:model="kerusakan" class="form-control" id="kerusakan"
                                        placeholder="Masukkan Jenis Kerusakan">
                                    @error('kerusakan')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="perbaikan">Perbaikan</label>
                                    <input type="text" wire:model="perbaikan" class="form-control" id="perbaikan"
                                        placeholder="Masukkan Jenis Perbaikan">
                                    @error('perbaikan')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alat">Alat</label>
                                    <input type="text" wire:model="alat" class="form-control" id="alat"
                                        placeholder="Masukkan Jenis Alat">
                                    @error('alat')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="bahan">Bahan</label>
                                    <input type="text" wire:model="bahan" class="form-control" id="bahan"
                                        placeholder="Masukkan Jenis Bahan">
                                    @error('bahan')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea wire:model="keterangan" class="form-control" name="keterangan" id="keterangan" cols="10" rows="5"></textarea>
                                    @error('keterangan')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a type="button" href="/admin/riwayat_tiang" class="btn btn-danger">Cancel</a>
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
