<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Jalan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('jalan.index') }}">Jalan</a></li>
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
                            <h3 class="card-title">Form Tambah Jalan</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form wire:submit="addJalan">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="kode">Kode</label>
                                    <input type="text" wire:model="kode" class="form-control" id="kode"
                                        placeholder="Masukkan Kode Jalan">
                                    @error('kode')
                                        <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Jalan</label>
                                    <input type="text" wire:model="nama" class="form-control" id="nama"
                                        placeholder="Masukkan Nama Jalan">
                                    @error('nama')
                                        <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="panjang">Panjang Jalan</label>
                                    <input type="text" wire:model="panjang" class="form-control" id="panjang"
                                        placeholder="Masukkan Panjang Jalan">
                                    @error('panjang')
                                        <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="lebar">Lebar Jalan</label>
                                    <input type="text" wire:model="lebar" class="form-control" id="lebar"
                                        placeholder="Masukkan Lebar Jalan">
                                    @error('lebar')
                                        <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">Status Jalan</label>
                                    <select name="status" wire:model="status" class="form-control">
                                        <option value="">-- Pilih Status Jalan --</option>
                                        <option value="Nasional">Nasional</option>
                                        <option value="Provinsi">Provinsi</option>
                                        <option value="Kota">Kota</option>
                                        <option value="Lingkungan">Lingkungan</option>
                                    </select>
                                    @error('status')
                                        <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kordinat">Kordinat</label>
                                    <input type="text" wire:model="kordinat" class="form-control" id="kordinat"
                                        placeholder="Masukkan Kordinat Jalan">
                                    @error('kordinat')
                                        <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="is_survey">Is Survey</label>
                                    <select name="is_survey" wire:model="is_survey" class="form-control">
                                        <option value="">-- Pilih Survey/Belum --</option>
                                        <option value="0">Belum Survey</option>
                                        <option value="1">Sudah Survey</option>
                                    </select>
                                    @error('is_survey')
                                        <span class="error text-danger text-sm font-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="ket">Keterangan</label>
                                    <textarea name="ket" wire:model="ket" class="form-control" cols="30" rows="5"
                                        placeholder="Masukkan Keterangan Jika Ada"></textarea>
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
