@extends('admin.layouts.main', ['title' => 'Pembiayaan'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    {{-- Pembiayaan --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Pembiayaan Desa</h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card-header">
                                    <button type="button" class="btn mb-2 btn-primary" data-toggle="modal"
                                        data-target="#pembiayaanModal"> <i class="fe fe-file-plus fe-16"></i>
                                        Tambah Pembiayaan </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="pembiayaanModal" tabindex="-1" role="dialog"
                                        aria-labelledby="pembiayaanModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="pembiayaanModalLabel">Tambah Pembiayaan</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('pembiayaan.store') }}" method="POST"
                                                    id="pembiayaanForm">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="kategori_pembiayaan">Kategori Pembiayaan</label>
                                                            <select
                                                                class="form-control @error('kategori_pembiayaan') is-invalid @enderror"
                                                                id="kategori_pembiayaan" name="kategori_pembiayaan"
                                                                required>
                                                                <option value="Penerimaan">Penerimaan</option>
                                                                <option value="Pengeluaran">Pengeluaran</option>
                                                            </select>
                                                            @error('kategori_pembiayaan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
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
                                            <th><strong>Kategori Pembiayaan</strong></th>
                                            <th><strong>Jumlah</strong></th>
                                            <th><strong>Uraian</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pembiayaan as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->kategori_pembiayaan }}</td>
                                                <td>Rp. {{ number_format($item->jumlah, 2, ',', '.') }}</td>
                                                <td>{{ $item->uraian }}</td>
                                                <td>
                                                    <form class="d-flex" method="POST"
                                                        action="{{ route('pembiayaan.destroy', $item->id) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kategori pembiayaan ini?');event.preventDefault();">
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
    {{-- end Pembiayaan --}}
@endsection
@section('scrip')
    <script>
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

        function unformatRupiah(input) {
            let value = input.value.trim();
            value = value.replace(/[^\d,-]/g, '');
            input.value = value;
        }

        document.getElementById('pembiayaanForm').addEventListener('submit', function(event) {
            const jumlahInput = document.getElementById('jumlah');
            unformatRupiah(jumlahInput);
        });
    </script>
@endsection
