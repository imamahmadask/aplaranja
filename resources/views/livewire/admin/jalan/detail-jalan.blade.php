<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Jalan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('jalan.index') }}">Jalan</a></li>
                        <li class="breadcrumb-item active">Detail</li>
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
                            <h3 class="card-title">Jalan {{ $nama }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td>Nama Jalan</td>
                                    <td>{{ $nama }}</td>
                                </tr>
                                <tr>
                                    <td>Kode Jalan</td>
                                    <td>{{ $kode }}</td>
                                </tr>
                                <tr>
                                    <td>Panjang</td>
                                    <td>{{ $panjang }} Km</td>
                                </tr>
                                <tr>
                                    <td>Lebar</td>
                                    <td>{{ $lebar }} meter</td>
                                </tr>
                                <tr>
                                    <td>Kordinat</td>
                                    <td>
                                        {{ $kordinat }}
                                        <a href="https://www.google.com/maps?q={{ $kordinat }}" target="_blank">
                                            (Show)
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Is Survey</td>
                                    <td>
                                        @if ($is_survey == 1)
                                            <div class="badge badge-success text-sm">
                                                Sudah
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                        @elseif ($is_survey == 0)
                                            <div class="badge badge-danger text-sm">
                                                Belum
                                                <i class="fas fa-times-circle"></i>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>{{ $ket }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-3">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Other Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td>Jumlah Panel</td>
                                    <td>{{ $countPanels }}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Tiang</td>
                                    <td>{{ $countTiangs }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-md-3">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Jenis Tiang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td>Besi</td>
                                    <td>{{ $countBesi }}</td>
                                </tr>
                                <tr>
                                    <td>Galvanis</td>
                                    <td>{{ $countGalvanis }}</td>
                                </tr>
                                <tr>
                                    <td>Dekoratif</td>
                                    <td>{{ $countDekoratif }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-md-3">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Kategori Tiang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td>Tiang</td>
                                    <td>{{ $countTiang }}</td>
                                </tr>
                                <tr>
                                    <td>Ornamen</td>
                                    <td>{{ $countOrnamen }}</td>
                                </tr>
                                <tr>
                                    <td>Gawang</td>
                                    <td>{{ $countGawang }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-md-3">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Jumlah Lengan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td>1 Lengan</td>
                                    <td>{{ $count1Lengan }}</td>
                                </tr>
                                <tr>
                                    <td>2 Lengan</td>
                                    <td>{{ $count2Lengan }}</td>
                                </tr>
                                <tr>
                                    <td>>2 Lengan</td>
                                    <td>{{ $count2MoreLengan }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-md-3">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Jenis Lampu</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td>LED</td>
                                    <td>{{ $countLed }}</td>
                                </tr>
                                <tr>
                                    <td>SON-T</td>
                                    <td>{{ $countSont }}</td>
                                </tr>
                                <tr>
                                    <td>Solar Cell</td>
                                    <td>{{ $countSolarCell }}</td>
                                </tr>
                                <tr>
                                    <td>Bohlam</td>
                                    <td>{{ $countBohlam }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>
