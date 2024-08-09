<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Panel</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Panel</li>
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
            <div class="row">
                <div class="col-4 mb-3">
                    <a href="{{ route('panel.create') }}" class="btn btn-app bg-primary">
                        <i class="fas fa-plus"></i> Add Data
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Panel</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tablePanel" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Panel</th>
                                        <th>Kwh</th>
                                        <th>Idpel</th>
                                        <th>Jaringan</th>
                                        <th>Saklar</th>
                                        <th>Kordinat</th>
                                        <th>Jalan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($this->panels as $panel)
                                        <tr wire:key="{{ $panel->id }}">
                                            <td>
                                                {{ $i++ }}
                                            </td>
                                            <td>
                                                {{ $panel->kode }}
                                            </td>
                                            <td>
                                                {{ $panel->kwh }}
                                            </td>
                                            <td>
                                                {{ $panel->idpel }}
                                            </td>
                                            <td>
                                                {{ $panel->jaringan }}
                                            </td>
                                            <td>
                                                {{ $panel->saklar }}
                                            </td>
                                            <td>
                                                {{ $panel->lat }}, {{ $panel->long }}
                                            </td>
                                            <td>
                                                {{ $panel->jalan->nama }}
                                            </td>
                                            <td>
                                                <a href="panel/{{ $panel->id }}/edit"
                                                    class="btn btn-sm btn-primary mx-2">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </a>
                                                <button wire:click="deletePanel({{ $panel->id }})"
                                                    wire:confirm="Are you sure you want to delete this Panel?"
                                                    class="btn btn-sm btn-danger">
                                                    DELETE
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
