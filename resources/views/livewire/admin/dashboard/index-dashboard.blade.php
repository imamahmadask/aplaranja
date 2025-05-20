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
                            <h3 class="card-title">Data Rekap Per Jalan</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text" wire:model.live="search_jalan" name="search_jalan"
                                        class="form-control float-right" placeholder="Search nama jalan">

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
                            <table id="tablePanel" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Kode Jalan</th>
                                        <th>Ruas Jalan</th>
                                        <th>Status Jalan</th>
                                        <th>Jml Panel</th>
                                        <th>Jml Tiang</th>
                                        <th>1 Lengan</th>
                                        <th>2 Lengan</th>
                                        <th>> 2 Lengan</th>
                                        <th>Jml Lampu</th>
                                        <th>is_survey</th>
                                        <th>Show</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($this->jalans as $data)
                                        <tr>
                                            <td>{{ $data->kode_jalan }}</td>
                                            <td>{{ $data->jalan }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td>{{ $data->jml_panel }}</td>
                                            <td>{{ $data->jml_tiang }}</td>
                                            <td>{{ $data->jml_1_lengan }}</td>
                                            <td>{{ $data->jml_2_lengan }}</td>
                                            <td>{{ $data->jml_lebih_lengan }}</td>
                                            <td>{{ $data->total_lampu }}</td>
                                            <td>
                                                @if ($data->is_survey == 1)
                                                    <div class="badge badge-success text-sm">
                                                        Sudah
                                                        <i class="fas fa-check-circle"></i>
                                                    </div>
                                                @elseif ($data->is_survey == 0)
                                                    <div class="badge badge-danger text-sm">
                                                        Belum
                                                        <i class="fas fa-times-circle"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('jalan.detail', ['id' => $data->id_jalan]) }}"
                                                    class="btn btn-info btn-sm" target="_blank">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <td><b>Total</b></td>
                                    <td><b>{{ $this->total_jalans->total_jalan }}</b></td>
                                    <td></td>
                                    <td><b>{{ $this->total_jalans->total_panel }}</b></td>
                                    <td><b>{{ $this->total_jalans->total_tiang }}</b></td>
                                    <td><b>{{ $this->total_jalans->total_1_lengan }}</b></td>
                                    <td><b>{{ $this->total_jalans->total_2_lengan }}</b></td>
                                    <td><b>{{ $this->total_jalans->total_lebih_lengan }}</b></td>
                                    <td><b>{{ $this->total_jalans->total_lampu }}</b></td>
                                    <td><b>{{ $this->total_jalans->total_is_survey }}</b></td>
                                </tfoot>
                            </table>
                            <div class="mx-4 my-2">
                                {{ $this->jalans->links() }}
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

        const jalans = {!! json_encode($jalans) !!};

        // Mendefinisikan ikon untuk jalan yang sudah disurvei dan yang belum
        var surveyedIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var notSurveyedIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        jalans.forEach(data => {
            // Memilih ikon berdasarkan status survey
            var icon = data.is_survey == 1 ? surveyedIcon : notSurveyedIcon;

            L.marker([data.lat, data.long], {
                    icon: icon
                }).addTo(map)
                .bindPopup(
                    '<h3>' + data.nama + '</h3>' +
                    '<p>Kode Jalan : ' + data.kode + '<br>' +
                    'Status : Jalan ' + data.status + '<br>' +
                    'Survey : ' + (data.is_survey == 1 ? 'Sudah' : 'Belum') + '<br>' +
                    'Jml Panel: ' + data.panel_count + '<br>' +
                    'Jml Tiang: ' + data.tiang_count + '<br>' +
                    'Jml Lampu: ' + data.lampu_count + '</p>'
                );
        });
    </script>
@endpush
