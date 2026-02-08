@extends('admin.layouts.main', ['title' => 'Belanja'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    {{-- Belanja --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Belanja Desa</h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card-header">
                                    <button type="button" class="btn mb-2 btn-primary" data-toggle="modal"
                                        data-target="#belanjaModal"> <i class="fe fe-file-plus fe-16"></i>
                                        Tambah Belanja </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="belanjaModal" tabindex="-1" role="dialog"
                                        aria-labelledby="belanjaModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="belanjaModalLabel">Tambah Belanja</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('belanja.store') }}" method="POST" id="belanjaForm">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="kategori_belanja">Kategori Belanja</label>
                                                            <select
                                                                class="form-control @error('kategori_belanja') is-invalid @enderror"
                                                                id="kategori_belanja" name="kategori_belanja" required>
                                                                <option value="Penyelenggaraan Pemerintahan Desa">
                                                                    Penyelenggaraan Pemerintahan Desa</option>
                                                                <option value="Pelaksanaan Pembangunan Desa">Pelaksanaan
                                                                    Pembangunan Desa</option>
                                                                <option value="Pembinaan Kemasyarakatan Desa">Pembinaan
                                                                    Kemasyarakatan Desa</option>
                                                                <option value="Pemberdayaan Masyarakat Desa">Pemberdayaan
                                                                    Masyarakat Desa</option>
                                                                <option
                                                                    value="Penanggulangan Bencana, Keadaan Darurat, dan Keadaan Mendesak Desa">
                                                                    Penanggulangan Bencana, Keadaan Darurat, dan Keadaan
                                                                    Mendesak Desa</option>
                                                            </select>
                                                            @error('kategori_belanja')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jumlah">Jumlah</label>
                                                            <input type="text" id="jumlah"
                                                                class="form-control @error('jumlah') is-invalid @enderror"
                                                                name="jumlah" value="{{ old('jumlah') }}" required
                                                                oninput="formatRupiah(this)">
                                                            @error('jumlah')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="uraian">Uraian</label>
                                                            <textarea class="form-control @error('uraian') is-invalid @enderror" id="uraian" name="uraian">{{ old('uraian') }}</textarea>
                                                            @error('uraian')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn mb-2 btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn mb-2 btn-primary">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>Kategori Belanja</strong></th>
                                            <th><strong>Jumlah</strong></th>
                                            <th><strong>Uraian</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($belanja as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->kategori_belanja }}</td>
                                                <td>Rp. {{ number_format($item->jumlah, 2, ',', '.') }}</td>
                                                <td>{{ $item->uraian }}</td>
                                                <td>
                                                    <form class="d-flex" method="POST"
                                                        action="{{ route('belanja.destroy', $item->id) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kategori belanja ini?');event.preventDefault();">
                                                            <i class="fe fe-trash-2"></i> Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
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
    {{-- end Belanja --}}
@endsection
@section('scrip')
    <script>
        // Fungsi untuk memformat input menjadi format Rupiah
        function formatRupiah(input) {
            let number_string = input.value.replace(/[^,\d]/g, '').toString();
            let split = number_string.split(',');
            let remain = split[0].length % 3;
            let rupiah = split[0].substr(0, remain);
            let thousands = split[0].substr(remain).match(/\d{3}/gi);

            if (thousands) {
                let separator = remain ? '.' : '';
                rupiah += separator + thousands.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1].substr(0, 2) : rupiah;

            input.value = 'Rp ' + rupiah;
        }

        // Fungsi untuk menghapus simbol 'Rp', titik ribuan, dan spasi ekstra
        function unformatRupiah(input) {
            let value = input.value.trim(); // Menghapus spasi tambahan
            // Menghilangkan simbol 'Rp' dan titik ribuan
            value = value.replace(/[^\d,-]/g, '');
            input.value = value;
        }

        // Handle form submission to unformat the 'jumlah' before submission
        document.getElementById('belanjaForm').addEventListener('submit', function(event) {
            const jumlahInput = document.getElementById('jumlah');
            unformatRupiah(jumlahInput); // Unformat before submitting
        });
    </script>
@endsection
