<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Riwayat Panel</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Riwayat Panel</li>
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
            <div class="row mb-3">
                <div class="col-4">
                    <a href="{{ route('riwayatPanel.create') }}" class="btn btn-app bg-primary">
                        <i class="fas fa-plus"></i> Add Data
                    </a>
                </div>
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Riwayat Panel</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" wire:model.live="search" name="search"
                                        class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed table-hover text-nowrap" id="tableRiwayatPanel">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Panel</th>
                                        <th>Tanggal</th>
                                        <th>Kerusakan</th>
                                        <th>Perbaikan</th>
                                        <th>Alat</th>
                                        <th>Bahan</th>
                                        <th>Keterangan</th>
                                        <th>Regu</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($this->riwayatPanels as $riwayatPanel)
                                        <tr wire:key="{{ $riwayatPanel->id }}">
                                            <td>
                                                {{ $i++ }}
                                            </td>
                                            <td>
                                                {{ $riwayatPanel->panel->kode }}
                                            </td>
                                            <td>
                                                {{ $riwayatPanel->tanggal }}
                                            </td>
                                            <td>
                                                {{ $riwayatPanel->jenis }}
                                            </td>
                                            <td>
                                                {{ $riwayatPanel->perbaikan }}
                                            </td>
                                            <td>
                                                {{ $riwayatPanel->alat }}
                                            </td>
                                            <td>
                                                {{ $riwayatPanel->bahan }}
                                            </td>
                                            <td>
                                                {{ Str::limit($riwayatPanel->keterangan, 50) }}
                                            </td>
                                            <td>
                                                {{ $riwayatPanel->regu->nama }}
                                            </td>
                                            <td>
                                                <a href="riwayat_panel/{{ $riwayatPanel->id }}/edit"
                                                    class="btn btn-sm btn-primary mx-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button wire:click="deleteRiwayatPanel({{ $riwayatPanel->id }})"
                                                    wire:confirm="Are you sure you want to delete this Riwayat?"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <td colspan="8">Total <strong>{{ $this->riwayatPanels->count() }}</strong></td>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
