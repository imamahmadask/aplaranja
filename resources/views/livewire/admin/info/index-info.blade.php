<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Info Umum</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Info Umum</li>
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
                <div class="row mb-3">
                    <div class="col-4">
                        <a href="{{ route('info.create') }}" class="btn btn-app bg-primary">
                            <i class="fas fa-plus"></i> Add Data
                        </a>
                    </div>
                </div>
            @endif

            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Info Umum</h3>

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
                            <table class="table table-head-fixed table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Item</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                        @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'User')
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($this->infos as $info)
                                        <tr wire:key="{{ $info->id }}">
                                            <td>
                                                {{ $i++ }}
                                            </td>
                                            <td>
                                                {{ $info->nama }}
                                            </td>
                                            <td>
                                                {{ $info->deskripsi }}
                                            </td>
                                            <td class="text-center">
                                                <img src="/storage/{{ $info->gambar }}" alt=""
                                                    class="img-circle" width="50px" height="50px">
                                            </td>
                                            @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'User')
                                                <td>
                                                    <a href="info/{{ $info->id }}/edit"
                                                        class="btn btn-sm btn-primary mx-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button wire:click="deleteInfo({{ $info->id }})"
                                                        wire:confirm="Are you sure you want to delete this Info?"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <td colspan="6">Total <strong>{{ $this->infos->count() }}</strong></td>
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
