@extends('admin.layouts.main', ['title' => 'Rt & Rw'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    {{--  rt --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Rt & Rw - Pengelolaan Koordinat GIS</h2>
                <p class="card-text">Kelola data RT/RW dan koordinat untuk peta GIS desa.</p>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn mb-2 btn-primary" data-toggle="modal"
                                        data-target="#Rt"> <i class="fe fe-file-plus fe-16"></i>
                                        Tambah Rt </button>
                                    <a href="{{ route('gis.index') }}" target="_blank" class="btn mb-2 btn-success">
                                        <i class="fe fe-map fe-16"></i> Lihat Peta GIS
                                    </a>
                                </div>
                                <!-- Modal Tambah RT -->
                                <div class="modal fade" id="Rt" tabindex="-1" role="dialog"
                                    aria-labelledby="RtLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="RtLabel">Tambah Rt Baru</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('rt.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="nama_rt">Nama Rt</label>
                                                                <input type="number" id="nama_rt"
                                                                    class="form-control @error('nama_rt') is-invalid @enderror"
                                                                    value="{{ old('nama_rt') }}" placeholder="Contoh: 01"
                                                                    name="nama_rt" required>
                                                                @error('nama_rt')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong class="text-danger">{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="latitude">Latitude</label>
                                                                <input type="text" id="latitude" class="form-control"
                                                                    placeholder="Contoh: -6.2088" name="latitude">
                                                                <small class="text-muted">Gunakan peta untuk memilih</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="longitude">Longitude</label>
                                                                <input type="text" id="longitude" class="form-control"
                                                                    placeholder="Contoh: 106.8456" name="longitude">
                                                                <small class="text-muted">Gunakan peta untuk memilih</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Mini Peta untuk memilih lokasi -->
                                                    <div class="form-group">
                                                        <label>Pilih Lokasi di Peta</label>
                                                        <div id="map-create-rt"
                                                            style="height: 300px; width: 100%; border-radius: 8px;"></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn mb-2 btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn mb-2 btn-primary">Tambah RT</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>Nama RT</strong></th>
                                            <th><strong>Latitude</strong></th>
                                            <th><strong>Longitude</strong></th>
                                            <th><strong>Status GIS</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rt as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><strong>RT {{ $item->nama_rt }}</strong></td>
                                                <td>{{ $item->latitude ?? '-' }}</td>
                                                <td>{{ $item->longitude ?? '-' }}</td>
                                                <td>
                                                    @if ($item->latitude && $item->longitude)
                                                        <span class="badge badge-success">Sudah Ada Koordinat</span>
                                                    @else
                                                        <span class="badge badge-warning">Belum Ada Koordinat</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-info btn-sm" data-toggle="modal"
                                                        data-target="#EditRt{{ $item->id }}">
                                                        <i class="fe fe-edit"></i> Edit
                                                    </button>
                                                    <form class="d-inline" method="POST"
                                                        action="{{ route('rt.delete', $item->id) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Anda yakin ingin menghapus RT {{ $item->nama_rt }} ini secara permanen?');event.preventDefault();
                                                                "><i
                                                                class="fe fe-trash-2"></i></button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit RT -->
                                            <div class="modal fade" id="EditRt{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="EditRtLabel{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="EditRtLabel{{ $item->id }}">
                                                                Edit RT {{ $item->nama_rt }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('rt.update', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('put')
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="nama_rt_{{ $item->id }}">Nama
                                                                                Rt</label>
                                                                            <input type="number" class="form-control"
                                                                                value="{{ $item->nama_rt }}"
                                                                                name="nama_rt" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="latitude_{{ $item->id }}">Latitude</label>
                                                                            <input type="text"
                                                                                id="latitude_{{ $item->id }}"
                                                                                class="form-control latitude-input"
                                                                                value="{{ $item->latitude }}"
                                                                                placeholder="Klik peta untuk pilih lokasi"
                                                                                name="latitude">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="longitude_{{ $item->id }}">Longitude</label>
                                                                            <input type="text"
                                                                                id="longitude_{{ $item->id }}"
                                                                                class="form-control longitude-input"
                                                                                value="{{ $item->longitude }}"
                                                                                placeholder="Klik peta untuk pilih lokasi"
                                                                                name="longitude">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Peta Edit -->
                                                                <div class="form-group">
                                                                    <label>Peta - Klik untuk memilih lokasi</label>
                                                                    <div id="map-edit-rt-{{ $item->id }}"
                                                                        class="map-edit-rt"
                                                                        data-lat="{{ $item->latitude ?? '' }}"
                                                                        data-lng="{{ $item->longitude ?? '' }}"
                                                                        style="height: 300px; width: 100%; border-radius: 8px;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn mb-2 btn-secondary"
                                                                    data-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn mb-2 btn-primary">Simpan
                                                                    Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    {{-- end rt --}}

    {{-- Rw --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <button type="button" class="btn mb-2 btn-primary" data-toggle="modal" data-target="#Rw">
                                <i class="fe fe-file-plus fe-16"></i>
                                Tambah Rw </button>
                            <a href="{{ route('gis.index') }}" target="_blank" class="btn mb-2 btn-success">
                                <i class="fe fe-map fe-16"></i> Lihat Peta GIS
                            </a>
                        </div>
                        <!-- Modal Tambah RW -->
                        <div class="modal fade" id="Rw" tabindex="-1" role="dialog" aria-labelledby="RwLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="RwLabel">Tambah Rw Baru</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('rw.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="nama_rw">Nama Rw</label>
                                                        <input type="number" id="nama_rw"
                                                            class="form-control @error('nama_rw') is-invalid @enderror"
                                                            value="{{ old('nama_rw') }}" placeholder="Contoh: 01"
                                                            name="nama_rw" required>
                                                        @error('nama_rw')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="latitude_rw">Latitude</label>
                                                        <input type="text" id="latitude_rw" class="form-control"
                                                            placeholder="Contoh: -6.2088" name="latitude">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="longitude_rw">Longitude</label>
                                                        <input type="text" id="longitude_rw" class="form-control"
                                                            placeholder="Contoh: 106.8456" name="longitude">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Mini Peta untuk memilih lokasi -->
                                            <div class="form-group">
                                                <label>Pilih Lokasi di Peta</label>
                                                <div id="map-create-rw"
                                                    style="height: 300px; width: 100%; border-radius: 8px;"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn mb-2 btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn mb-2 btn-primary">Tambah RW</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- table -->
                        <table class="table datatables" id="dataTable-2">
                            <thead>
                                <tr>
                                    <th><strong>#</strong></th>
                                    <th><strong>Nama RW</strong></th>
                                    <th><strong>Latitude</strong></th>
                                    <th><strong>Longitude</strong></th>
                                    <th><strong>Status GIS</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rw as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>RW {{ $item->nama_rw }}</strong></td>
                                        <td>{{ $item->latitude ?? '-' }}</td>
                                        <td>{{ $item->longitude ?? '-' }}</td>
                                        <td>
                                            @if ($item->latitude && $item->longitude)
                                                <span class="badge badge-success">Sudah Ada Koordinat</span>
                                            @else
                                                <span class="badge badge-warning">Belum Ada Koordinat</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#EditRw{{ $item->id }}">
                                                <i class="fe fe-edit"></i> Edit
                                            </button>
                                            <form class="d-inline" method="POST"
                                                action="{{ route('rw.delete', $item->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Anda yakin ingin menghapus RW {{ $item->nama_rw }} ini secara permanen?');event.preventDefault();
                                                        "><i
                                                        class="fe fe-trash-2"></i></button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit RW -->
                                    <div class="modal fade" id="EditRw{{ $item->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="EditRwLabel{{ $item->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="EditRwLabel{{ $item->id }}">
                                                        Edit RW {{ $item->nama_rw }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('rw.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="nama_rw_{{ $item->id }}">Nama
                                                                        Rw</label>
                                                                    <input type="number" class="form-control"
                                                                        value="{{ $item->nama_rw }}" name="nama_rw"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="latitude_rw_{{ $item->id }}">Latitude</label>
                                                                    <input type="text"
                                                                        id="latitude_rw_{{ $item->id }}"
                                                                        class="form-control latitude-input-rw"
                                                                        value="{{ $item->latitude }}"
                                                                        placeholder="Klik peta untuk pilih lokasi"
                                                                        name="latitude">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="longitude_rw_{{ $item->id }}">Longitude</label>
                                                                    <input type="text"
                                                                        id="longitude_rw_{{ $item->id }}"
                                                                        class="form-control longitude-input-rw"
                                                                        value="{{ $item->longitude }}"
                                                                        placeholder="Klik peta untuk pilih lokasi"
                                                                        name="longitude">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Peta Edit -->
                                                        <div class="form-group">
                                                            <label>Peta - Klik untuk memilih lokasi</label>
                                                            <div id="map-edit-rw-{{ $item->id }}" class="map-edit-rw"
                                                                data-lat="{{ $item->latitude ?? '' }}"
                                                                data-lng="{{ $item->longitude ?? '' }}"
                                                                style="height: 300px; width: 100%; border-radius: 8px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn mb-2 btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn mb-2 btn-primary">Simpan
                                                            Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- simple table -->
        </div> <!-- end section -->
    </div> <!-- .col-12 -->
    </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    {{-- end rw --}}
@endsection

@section('scripts')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Default coordinates (Desa Dotte - Maluku)
            const defaultCenter = [0.4002398820443033, 128.2953513388323];
            let maps = {};
            let markers = {};

            // Initialize map for Create RT
            const mapCreateRt = L.map('map-create-rt').setView(defaultCenter, 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(mapCreateRt);

            mapCreateRt.on('click', function(e) {
                const {
                    lat,
                    lng
                } = e.latlng;
                document.getElementById('latitude').value = lat.toFixed(6);
                document.getElementById('longitude').value = lng.toFixed(6);

                if (markers['createRt']) mapCreateRt.removeLayer(markers['createRt']);
                markers['createRt'] = L.marker([lat, lng]).addTo(mapCreateRt)
                    .bindPopup(`Lokasi dipilih: ${lat.toFixed(6)}, ${lng.toFixed(6)}`).openPopup();
            });

            // Initialize map for Create RW
            const mapCreateRw = L.map('map-create-rw').setView(defaultCenter, 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(mapCreateRw);

            mapCreateRw.on('click', function(e) {
                const {
                    lat,
                    lng
                } = e.latlng;
                document.getElementById('latitude_rw').value = lat.toFixed(6);
                document.getElementById('longitude_rw').value = lng.toFixed(6);

                if (markers['createRw']) mapCreateRw.removeLayer(markers['createRw']);
                markers['createRw'] = L.marker([lat, lng]).addTo(mapCreateRw)
                    .bindPopup(`Lokasi dipilih: ${lat.toFixed(6)}, ${lng.toFixed(6)}`).openPopup();
            });

            // Initialize maps for Edit RT
            document.querySelectorAll('.map-edit-rt').forEach(function(mapElement) {
                const id = mapElement.id.replace('map-edit-rt-', '');
                const lat = mapElement.dataset.lat;
                const lng = mapElement.dataset.lng;
                const center = (lat && lng) ? [parseFloat(lat), parseFloat(lng)] : defaultCenter;

                maps['rt_' + id] = L.map(id).setView(center, 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(maps['rt_' + id]);

                if (lat && lng) {
                    markers['rt_' + id] = L.marker([lat, lng]).addTo(maps['rt_' + id])
                        .bindPopup('Lokasi saat ini').openPopup();
                }

                maps['rt_' + id].on('click', function(e) {
                    const {
                        lat: newLat,
                        lng: newLng
                    } = e.latlng;
                    document.getElementById('latitude_' + id).value = newLat.toFixed(6);
                    document.getElementById('longitude_' + id).value = newLng.toFixed(6);

                    if (markers['rt_' + id]) maps['rt_' + id].removeLayer(markers['rt_' + id]);
                    markers['rt_' + id] = L.marker([newLat, newLng]).addTo(maps['rt_' + id])
                        .bindPopup(`Lokasi dipilih: ${newLat.toFixed(6)}, ${newLng.toFixed(6)}`)
                        .openPopup();
                });
            });

            // Initialize maps for Edit RW
            document.querySelectorAll('.map-edit-rw').forEach(function(mapElement) {
                const id = mapElement.id.replace('map-edit-rw-', '');
                const lat = mapElement.dataset.lat;
                const lng = mapElement.dataset.lng;
                const center = (lat && lng) ? [parseFloat(lat), parseFloat(lng)] : defaultCenter;

                maps['rw_' + id] = L.map(id).setView(center, 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(maps['rw_' + id]);

                if (lat && lng) {
                    markers['rw_' + id] = L.marker([lat, lng]).addTo(maps['rw_' + id])
                        .bindPopup('Lokasi saat ini').openPopup();
                }

                maps['rw_' + id].on('click', function(e) {
                    const {
                        lat: newLat,
                        lng: newLng
                    } = e.latlng;
                    document.getElementById('latitude_rw_' + id).value = newLat.toFixed(6);
                    document.getElementById('longitude_rw_' + id).value = newLng.toFixed(6);

                    if (markers['rw_' + id]) maps['rw_' + id].removeLayer(markers['rw_' + id]);
                    markers['rw_' + id] = L.marker([newLat, newLng]).addTo(maps['rw_' + id])
                        .bindPopup(`Lokasi dipilih: ${newLat.toFixed(6)}, ${newLng.toFixed(6)}`)
                        .openPopup();
                });
            });

            // Fix map size issue when modal opens
            $('[data-toggle="modal"]').on('click', function() {
                setTimeout(function() {
                    mapCreateRt.invalidateSize();
                    mapCreateRw.invalidateSize();
                    Object.keys(maps).forEach(function(key) {
                        maps[key].invalidateSize();
                    });
                }, 100);
            });
        });
    </script>
@endsection