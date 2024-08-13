<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Panel</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('panel.index') }}">Panel</a></li>
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
                        <form wire:submit="addPanel">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="lebar">Jalan</label>
                                    <select name="jalan_id" wire:model.live="jalan_id" class="form-control">
                                        <option value="">Pilih Jalan</option>
                                        @foreach ($jalans as $jalan)
                                            <option value={{ $jalan->id }}>{{ $jalan->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kode">Kode</label>
                                    <input type="text" wire:model="kode" class="form-control" id="kode"
                                        placeholder="Masukkan Kode Panel">
                                </div>

                                <div class="form-group">
                                    <label for="kwh">Kwh</label>
                                    <input type="text" wire:model="kwh" class="form-control" id="kwh"
                                        placeholder="Masukkan KWh Panel">
                                </div>

                                <div class="form-group">
                                    <label for="idpel">Idpel</label>
                                    <input type="text" wire:model="idpel" class="form-control" id="idpel"
                                        placeholder="Masukkan idpel Panel">
                                </div>

                                <div class="form-group">
                                    <label for="jaringan">Jaringan</label>
                                    <select name="jaringan" wire:model="jaringan" class="form-control">
                                        <option value="">Pilih Jaringan</option>
                                        <option value="1">1 Jaringan</option>
                                        <option value="2">2 Jaringan</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="saklar">Saklar</label>
                                    <select name="saklar" wire:model="saklar" class="form-control">
                                        <option value="">Pilih Saklar</option>
                                        <option value="Timmer">Timmer</option>
                                        <option value="Photocell">Photocell</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kordinat">Kordinat</label>
                                    <input type="text" wire:model="kordinat" class="form-control" id="kordinat"
                                        placeholder="Masukkan Kordinat">
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
