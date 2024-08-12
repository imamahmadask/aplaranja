<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jalan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Jalan</li>
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
                    <a href="{{ route('jalan.create') }}" class="btn btn-app bg-primary">
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
                        <form wire:submit.prevent="addJalan">
                            <div class="form-group">
                                <label for="fileJalan" class="font-weight-bold">Import Data Jalan</label>
                                <input type="file" class="form-control" wire:model="fileJalan" />
                            </div>

                            @error('fileJalan')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror

                            <div wire:loading wire:target="fileJalan" wire:key="fileJalan"><i
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

            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Jalan</h3>

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
                                        <th>Kode Jalan</th>
                                        <th>Nama Jalan</th>
                                        <th>Panjang Jalan</th>
                                        <th>Lebar Jalan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($this->jalans as $jalan)
                                        <tr wire:key="{{ $jalan->id }}">
                                            <td>
                                                {{ $i++ }}
                                            </td>
                                            <td>
                                                {{ $jalan->kode }}
                                            </td>
                                            <td>
                                                {{ $jalan->nama }}
                                            </td>
                                            <td>
                                                {{ $jalan->panjang }} meter
                                            </td>
                                            <td>{{ $jalan->lebar }} meter</td>
                                            <td>
                                                <a href="jalan/{{ $jalan->id }}/edit"
                                                    class="btn btn-sm btn-primary mx-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button wire:click="deleteJalan({{ $jalan->id }})"
                                                    wire:confirm="Are you sure you want to delete this post?"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <td colspan="6">Total <strong>{{ $this->jalans->count() }}</strong></td>
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
@push('scripts')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endpush
