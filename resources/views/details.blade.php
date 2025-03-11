@extends('layouts.guest.app')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <div class="container">
            <div class="row gy-4 justify-content-between">
                <div class="col-lg-4 order-lg-last hero-img">
                    <div id="map-detail" style="width: 100%; height: 500px;"></div>
                </div>

                <div class="col-lg-6  d-flex flex-column justify-content-center">
                    <table>
                        <tr>
                            <td>
                                <h3>Kode Tiang</h3>
                            </td>
                            <td>
                                <h3>: {{ $tiang->kode }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Jalan</h3>
                            </td>
                            <td>
                                <h3>: {{ $tiang->panel->jalan->nama }}</h3>
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <table class="table table-striped">
                        <tr>
                            <td>
                                Kategori Tiang
                            </td>
                            <td>
                                {{ $tiang->kategori }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jenis Tiang
                            </td>
                            <td>
                                {{ $tiang->jenis }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jumlah Lengan
                            </td>
                            <td>
                                {{ $tiang->lengan }} Lengan
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tahun Pengadaan
                            </td>
                            <td>
                                {{ $tiang->tahun_pengadaan }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jenis Jaringan
                            </td>
                            <td>
                                {{ $tiang->jaringan }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Posisi Tiang
                            </td>
                            <td>
                                {{ $tiang->posisi_tiang }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jenis Lampu
                            </td>
                            <td>
                                {{ $tiang->lampu }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Kondisi Tiang
                            </td>
                            <td>
                                {{ $tiang->kondisi }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Koordinat
                            </td>
                            <td>
                                {{ $tiang->lat }}, {{ $tiang->long }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        var map = L.map('map-detail').setView([{{ $tiang->lat }}, {{ $tiang->long }}], 15);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var tiangIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        L.marker([{{ $tiang->lat }}, {{ $tiang->long }}], {
                icon: tiangIcon
            })
            .addTo(map)
            .bindPopup(
                '<h4 style="color: black;">{{ $tiang->kode }}</h4>' +
                '<p style="color: black; font-size: 14px;">Jl. {{ $tiang->panel->jalan->nama }}<br>' +
                'Koordinat: <a href="https://www.google.com/maps?q={{ $tiang->lat }},{{ $tiang->long }}" target="_blank" style="color: blue; text-decoration: underline;">Buka di Google Maps</a></p>'
            );
    </script>
@endpush
