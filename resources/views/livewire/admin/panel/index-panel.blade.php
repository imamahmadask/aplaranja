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
            @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'User')
                <div class="row">
                    <div class="col-4 mb-3">
                        <a href="{{ route('panel.create') }}" class="btn btn-app bg-primary">
                            <i class="fas fa-plus"></i> Add Data
                        </a>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="row p-3">
                        <div class="col">
                            @if (session()->has('message'))
                                <div class="alert alert-success text-center">{{ session('message') }}</div>
                            @endif
                            <form wire:submit.prevent="addPanel">
                                <div class="form-group">
                                    <label for="filePanel" class="font-weight-bold">Import Data Panel</label>
                                    <input type="file" class="form-control" wire:model="filePanel" />
                                </div>

                                @error('filePanel')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror

                                <div wire:loading wire:target="filePanel" wire:key="filePanel"><i
                                        class="fa fa-spinner fa-spin mt-2 ml-2"></i> Uploading
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary w-20 mt-2">
                                        <div wire:loading wire:target="addJalan" wire:key="addJalan"><i
                                                class="fa fa-spinner fa-spin"></i></div> Import
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Panel</h3>

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
                            <table id="tablePanel" class="table table-head-fixed table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Panel</th>
                                        <th>Jalan</th>
                                        <th>Kwh</th>
                                        <th>Idpel</th>
                                        <th>Jaringan</th>
                                        <th>Saklar</th>
                                        <th>Kordinat</th>
                                        <th>Riwayat</th>
                                        @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'User')
                                            <th>Action</th>
                                        @endif
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
                                                {{ $panel->jalan->nama }}
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
                                                {{ $panel->riwayat->count() }}
                                            </td>
                                            @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'User')
                                                <td>
                                                    <a href="panel/{{ $panel->id }}/edit"
                                                        class="btn btn-sm btn-primary mx-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button wire:click="deletePanel({{ $panel->id }})"
                                                        wire:confirm="Are you sure you want to delete this Panel?"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <td colspan="10">Total <strong>{{ $this->panels->count() }}</strong></td>
                                </tfoot>
                            </table>
                            <div class="mx-4 my-2">
                                {{ $this->panels->links() }}
                            </div>
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
