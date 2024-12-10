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
                <div class="col-md-6">
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
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Map</h3>
                        </div>
                        <div class="card-body">
                            <div id="mapDetail" style="width: 100%; height: 340px;"></div>
                        </div>
                    </div>
                </div>
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
                            <h3 class="card-title">Jumlah Lengan ({{ $totalLengan }})</h3>
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
                            <h3 class="card-title">Jenis Lampu ({{ $totalLampu }})</h3>
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

                <div class="col-md-3">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Kondisi Tiang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td>Normal</td>
                                    <td>{{ $countNormal }}</td>
                                </tr>
                                <tr>
                                    <td>Rusak Ringan</td>
                                    <td>{{ $countRusakRingan }}</td>
                                </tr>
                                <tr>
                                    <td>Rusak Sedang</td>
                                    <td>{{ $countRusakSedang }}</td>
                                </tr>
                                <tr>
                                    <td>Rusak Berat</td>
                                    <td>{{ $countRusakBerat }}</td>
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
@push('scripts')
    <script>
        // Inisialisasi peta dengan view default
        var map = L.map('mapDetail').setView([-8.584587387437304, 116.10220505631855], 13);

        // Menambahkan layer peta
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Data latitude dan longitude
        const koordinat = {!! json_encode($kordinat) !!}; // Format: "-8.586782, 116.077263"

        // Data tambahan
        const namaJalan = {!! json_encode($nama) !!}; // Contoh: "Jalan Mawar"
        const kodeJalan = {!! json_encode($kode) !!}; // Contoh: "JM001"
        const isSurvey = {!! json_encode($is_survey) !!}; // Contoh: 1

        // Memisahkan koordinat menjadi latitude dan longitude
        const [lat, long] = koordinat.split(',').map(coord => parseFloat(coord.trim()));

        // Menentukan ikon berdasarkan status survei
        var icon = isSurvey == 1 ?
            L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            }) :
            L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

        // Menambahkan marker pada peta
        L.marker([lat, long], {
                icon: icon
            })
            .addTo(map)
            .bindPopup(
                '<h3>' + namaJalan + '</h3>' +
                '<p>Kode Jalan : ' + kodeJalan + '<br>' +
                'Survey : ' + (isSurvey == 1 ? 'Sudah' : 'Belum') + '</p>'
            )
            .openPopup(); // Membuka popup secara default
    </script>
@endpush
