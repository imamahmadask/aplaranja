<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tiang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Tiang</li>
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
                        <a href="{{ route('tiang.create') }}" class="btn btn-app bg-primary">
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
                            <form wire:submit.prevent="addTiang">
                                <div class="form-group">
                                    <label for="fileTiang" class="font-weight-bold">Import Data Tiang</label>
                                    <input type="file" class="form-control" wire:model="fileTiang" />
                                </div>

                                @error('fileTiang')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror

                                <div wire:loading wire:target="fileTiang" wire:key="fileTiang"><i
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
                            <h3 class="card-title">Data Tiang</h3>

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
                            <table id="tableTiang" class="table table-head-fixed table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Kode Tiang</th>
                                        <th>Kategori</th>
                                        <th>Jenis</th>
                                        <th>Lengan</th>
                                        <th>Pengadaan</th>
                                        <th>Jaringan</th>
                                        <th>Posisi</th>
                                        <th>Lampu</th>
                                        <th>Kondisi</th>
                                        <th>Kordinat</th>
                                        <th>Riwayat</th>
                                        @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'User')
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($this->tiangs as $tiang)
                                        <tr wire:key="{{ $tiang->id }}">
                                            <td>
                                                {{ $tiang->kode }}
                                            </td>
                                            <td>
                                                {{ $tiang->kategori }}
                                            </td>
                                            <td>
                                                {{ $tiang->jenis }}
                                            </td>
                                            <td>
                                                {{ $tiang->lengan }}
                                            </td>
                                            <td>
                                                {{ $tiang->tahun_pengadaan }}
                                            </td>
                                            <td>
                                                {{ $tiang->jaringan }}
                                            </td>
                                            <td>
                                                {{ $tiang->posisi_tiang }}
                                            </td>
                                            <td>
                                                {{ $tiang->lampu }}
                                            </td>
                                            <td>
                                                {{ $tiang->kondisi }}
                                            </td>
                                            <td>
                                                {{ $tiang->lat }}, {{ $tiang->long }}
                                            </td>
                                            <td>
                                                {{ $tiang->riwayat->count() }}
                                            </td>
                                            @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'User')
                                                <td>
                                                    <a href="{{ route('tiang.edit', ['id' => $tiang->id]) }}"
                                                        class="btn btn-sm btn-primary mx-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button wire:click="deleteTiang({{ $tiang->id }})"
                                                        wire:confirm="Are you sure you want to delete this Tiang?"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <td colspan="12">Total <strong>{{ $this->tiangs->count() }}</strong></td>
                                </tfoot>
                            </table>
                            <div class="mx-4 my-2">
                                {{ $this->tiangs->links() }}
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
