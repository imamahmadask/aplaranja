<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->

            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $stat['count_jalan'] }}</h3>

                            <p>Jumlah Jalan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-road"></i>
                        </div>
                        <a href="{{ route('jalan.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $stat['count_panel'] }}</h3>

                            <p>Jumlah Panel</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <a href="{{ route('panel.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $stat['count_tiang'] }}</h3>

                            <p>Jumlah Tiang</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <a href="{{ route('tiang.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $stat['count_regu'] }}</h3>

                            <p>Jumlah Regu</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('regu.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->

            {{-- <div class="row">
                <div class="col bg-light mx-2 mb-2 p-2 rounded shadow-sm">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Filter By Jalan</label>
                                <select class="form-control">
                                    <option value="Jl. Brawijaya">Jl. Brawijaya</option>
                                    <option value="Jl. Sriwijaya">Jl. Sriwijaya</option>
                                    <option value="Jl. Majapahit">Jl. Majapahit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Tiang/Panel</label>
                                <select class="form-control">
                                    <option value="All">All</option>
                                    <option value="Tiang">Tiang</option>
                                    <option value="Panel">Panel</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Rekap Tiang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table id="tablePanel" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Kode Jalan</th>
                                        <th>Ruas Jalan</th>
                                        <th>Jml Panel</th>
                                        <th>Jml Tiang</th>
                                        <th>Tiang Galpanis</th>
                                        <th>Tiang Besi</th>
                                        <th>Tiang Dekor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($this->tiangs as $data)
                                        <tr>
                                            <td>{{ $data->kode_jalan }}</td>
                                            <td>{{ $data->jalan }}</td>
                                            <td>{{ $data->jml_panel }}</td>
                                            <td>{{ $data->jml_tiang }}</td>
                                            <td>{{ $data->jml_tiang_galpanis }}</td>
                                            <td>{{ $data->jml_tiang_besi }}</td>
                                            <td>{{ $data->jml_tiang_dekor }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-2">
                                {{ $this->tiangs->links() }}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Map View</h3>
                        </div>
                        <div wire:ignore>
                            <div class="card-body p-0">
                                <div class="d-md-flex">
                                    <div class="p-1 flex-fill" style="overflow: hidden">
                                        <div id="map"></div>
                                    </div>

                                    {{-- <div class="card-pane-right bg-success pt-2 pb-2 pl-4 pr-4">
                                        <div class="description-block mb-4">
                                            <div class="sparkbar pad" data-color="#fff">90,70,90,70,75,80,70</div>
                                            <h5 class="description-header">8390</h5>
                                            <span class="description-text">Visits</span>
                                        </div>
                                        <!-- /.description-block -->
                                        <div class="description-block mb-4">
                                            <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                                            <h5 class="description-header">30%</h5>
                                            <span class="description-text">Referrals</span>
                                        </div>
                                        <!-- /.description-block -->
                                        <div class="description-block">
                                            <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                                            <h5 class="description-header">70%</h5>
                                            <span class="description-text">Organic</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div><!-- /.card-pane-right --> --}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
@push('scripts')
    <script>
        var map = L.map('map').setView([-8.584587387437304, 116.10220505631855], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const tiangs = {!! json_encode($tiangs) !!};


        tiangs.forEach(data => {
            L.marker([data.lat, data.long]).addTo(map)
                .bindPopup(
                    '<h3>' + data.kode + '</h3>' + '<p>Kategori : ' + data.kategori + '<br> Jenis : ' + data.jenis +
                    '</p>'
                );
        });
    </script>
@endpush
