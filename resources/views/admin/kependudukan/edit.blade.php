@extends('admin.layouts.main', ['title' => 'Edit Data Penduduk'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Edit Data Penduduk</h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card-header">
                                    <a href="{{ route('datapenduduk.index') }}" class="btn btn-secondary"><i
                                            class="fe fe-arrow-left"></i> Kembali</a>
                                </div>
                                {{-- form --}}
                                <form action="{{ route('datapenduduk.update', $penduduk->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3 mt-3">

                                        <div class="form-group col-md-6">
                                            <label for="select-rt">Rt </label>
                                            <select class="form-control select2" id="select-rt" name="id_rt" autofocus
                                                required>
                                                <optgroup label="-- Pilih Rt --">
                                                    @foreach ($rt as $rt)
                                                        <option @if ($penduduk->id_rt == $rt->id) {{ 'selected' }} @endif
                                                            value="{{ $rt->id }}">Rt {{ $rt->nama_rt }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div> <!-- Rt -->
                                        <div class="form-group col-md-6">
                                            <label for="select-rw">Rw </label>
                                            <select class="form-control select2" id="select-rw" name="id_rw" required>
                                                <optgroup label="-- Pilih Rw --">
                                                    @foreach ($rw as $rw)
                                                        <option @if ($penduduk->id_rw == $rw->id) {{ 'selected' }} @endif
                                                            value="{{ $rw->id }}">Rw {{ $rw->nama_rw }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div> <!-- Rw -->
                                        <div class="form-group col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="simpleinput">Dusun</label>
                                                <input type="text" id="simpleinput" name="dusun"
                                                    class="form-control  @error('dusun') is-invalid @enderror"
                                                    value="{{ old('dusun', $penduduk->dusun ?? 'Kampung Makassar Barat') }}"
                                                    placeholder="Dusun" required>
                                                @error('dusun')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> <!-- dusun -->
                                        <div class="form-group col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="simpleinput">Alamat </label>
                                                <input name="alamat" type="text" id="simpleinput"
                                                    class="form-control @error('alamat') is-invalid @enderror"
                                                    value="{{ old('alamat', $penduduk->alamat) }}" placeholder="Alamat"
                                                    required>
                                                @error('alamat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> <!-- alamat -->
                                        <div class="form-group col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="simpleinput">Nomor Kartu Keluarga </label>
                                                <input type="number" id="simpleinput"
                                                    class="form-control @error('no_kk') is-invalid @enderror"
                                                    value="{{ old('no_kk', $penduduk->no_kk) }}"
                                                    placeholder="Nomor Kartu Keluarga" name="no_kk" required>
                                                @error('no_kk')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> <!-- no_kk -->
                                        <div class="form-group col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="simpleinput">Nama Kepala Keluarga </label>
                                                <input type="text" id="simpleinput"
                                                    class="form-control @error('nama_kepala_keluarga') is-invalid @enderror"
                                                    value="{{ old('nama_kepala_keluarga', $penduduk->nama_kepala_keluarga) }}"
                                                    placeholder="Nama Kepala Keluarga" name="nama_kepala_keluarga" required>
                                                @error('nama_kepala_keluarga')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> <!-- nama kepala keluarga -->
                                        <div class="form-group col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="simpleinput">Nama Penduduk </label>
                                                <input type="text" id="simpleinput"
                                                    class="form-control @error('nama') is-invalid @enderror"
                                                    value="{{ old('nama', $penduduk->nama) }}" name="nama"
                                                    placeholder="Nama" required>
                                                @error('nama')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> <!-- nama -->
                                        <div class="form-group col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="simpleinput">Nomor Induk Kependudukan </label>
                                                <input type="number" id="simpleinput"
                                                    class="form-control @error('nik') is-invalid @enderror"
                                                    value="{{ old('nik', $penduduk->nik) }}" name="nik"
                                                    placeholder="Nik" required>
                                                @error('nik')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> <!-- nik -->
                                        <div class="form-group col-md-6">
                                            <label for="select-jenis-kelamin">Jenis Kelamin </label>
                                            <select class="form-control select2" id="select-jenis-kelamin"
                                                name="jenis_kelamin" required>
                                                <optgroup label="-- Jenis Kelamin --">
                                                    <option @if ($penduduk->jenis_kelamin == 'LAKI-LAKI') {{ 'selected' }} @endif
                                                        value="LAKI-LAKI">LAKI-LAKI</option>
                                                    <option @if ($penduduk->jenis_kelamin == 'PEREMPUAN') {{ 'selected' }} @endif
                                                        value="PEREMPUAN">PEREMPUAN</option>
                                                </optgroup>
                                            </select>
                                        </div> <!-- jenis kelamin -->
                                        <div class="form-group col-md-6">
                                            <label for="select-hubungan">Hubungan Dengan Kepala Keluarga </label>
                                            <select class="form-control select2" id="select-hubungan" name="hubungan"
                                                required>
                                                <optgroup label="-- Hubungan --">
                                                    <option @if ($penduduk->hubungan == 'Kepala Keluarga') {{ 'selected' }} @endif
                                                        value="Kepala Keluarga">Kepala Keluarga</option>
                                                    <option @if ($penduduk->hubungan == 'Istri') {{ 'selected' }} @endif
                                                        value="Istri">Istri</option>
                                                    <option @if ($penduduk->hubungan == 'Anak Kandung') {{ 'selected' }} @endif
                                                        value="Anak Kandung">Anak Kandung</option>
                                                    <option @if ($penduduk->hubungan == 'Mertua') {{ 'selected' }} @endif
                                                        value="Mertua">Mertua</option>
                                                    <option @if ($penduduk->hubungan == 'Ibu') {{ 'selected' }} @endif
                                                        value="Ibu">Ibu</option>
                                                    <option @if ($penduduk->hubungan == 'Ayah') {{ 'selected' }} @endif
                                                        value="Ayah">Ayah</option>
                                                    <option @if ($penduduk->hubungan == 'Cucu') {{ 'selected' }} @endif
                                                        value="Cucu">Cucu</option>
                                                    <option @if ($penduduk->hubungan == 'Adik') {{ 'selected' }} @endif
                                                        value="Adik">Adik</option>
                                                </optgroup>
                                            </select>
                                        </div> <!-- hubungan -->
                                        <div class="form-group col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="tempat_lahir">Tempat Lahir </label>
                                                <input type="text" id="tempat_lahir"
                                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                    value="{{ old('tempat_lahir', $penduduk->tempat_lahir) }}"
                                                    name="tempat_lahir" placeholder="Tempat Lahir" required>
                                                @error('tempat_lahir')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> <!-- tempat lahir -->
                                        <div class="form-group col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="tanggal_lahir">Tanggal Lahir </label>
                                                <input type="date" id="tanggal_lahir"
                                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                    value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir) }}"
                                                    name="tanggal_lahir" placeholder="Tanggal Lahir" required>
                                                @error('tanggal_lahir')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> <!-- tanggal lahir -->
                                        <div class="form-group col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="usia">Usia </label>
                                                <input type="number" id="usia"
                                                    class="form-control @error('usia') is-invalid @enderror"
                                                    value="{{ old('usia', $penduduk->usia) }}" name="usia"
                                                    placeholder="Usia" required>
                                                @error('usia')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> <!-- usia -->
                                        <div class="form-group col-md-6">
                                            <label for="simple-select2">Status </label>
                                            <select class="form-control select2" id="status-select" name="status"
                                                required>
                                                <optgroup label="-- Status --">
                                                    <option @if ($penduduk->status == 'Kawin') {{ 'selected' }} @endif
                                                        value="Kawin">Kawin</option>
                                                    <option @if ($penduduk->status == 'Belum Kawin') {{ 'selected' }} @endif
                                                        value="Belum Kawin">Belum Kawin</option>
                                                    <option @if ($penduduk->status == 'Janda/Duda') {{ 'selected' }} @endif
                                                        value="Janda/Duda">Janda/Duda</option>
                                                </optgroup>
                                            </select>
                                        </div> <!-- status -->

                                        <div class="form-group col-md-6">
                                            <label for="select-agama">Agama </label>
                                            <select class="form-control select2" id="select-agama" name="agama"
                                                required>
                                                <optgroup label="-- Agama --">
                                                    <option @if ($penduduk->agama == 'ISLAM') {{ 'selected' }} @endif
                                                        value="ISLAM">Islam</option>
                                                    <option @if ($penduduk->agama == 'KRISTEN PROTESTAN') {{ 'selected' }} @endif
                                                        value="KRISTEN PROTESTAN">Kristen Protestan</option>
                                                    <option @if ($penduduk->agama == 'KRISTEN KATOLIK') {{ 'selected' }} @endif
                                                        value="KRISTEN KATOLIK">Kristen Katolik</option>
                                                    <option @if ($penduduk->agama == 'HINDU') {{ 'selected' }} @endif
                                                        value="HINDU">Hindu</option>
                                                    <option @if ($penduduk->agama == 'BUDDHA') {{ 'selected' }} @endif
                                                        value="BUDDHA">Buddha</option>
                                                    <option @if ($penduduk->agama == 'KONGHUCU') {{ 'selected' }} @endif
                                                        value="KONGHUCU">Konghucu</option>
                                                    <option @if ($penduduk->agama == 'AGAMA LAINNYA') {{ 'selected' }} @endif
                                                        value="AGAMA LAINNYA">Agama lainnya</option>
                                                </optgroup>
                                            </select>
                                        </div> <!-- agama -->
                                        <div class="form-group col-md-6">
                                            <label for="select-golongan-darah">Golongan Darah </label>
                                            <select class="form-control select2" id="select-golongan-darah"
                                                name="golongan_darah" required>
                                                <optgroup label="-- Golongan Darah --">
                                                    <option @if ($penduduk->golongan_darah == 'A') {{ 'selected' }} @endif
                                                        value="A">A</option>
                                                    <option @if ($penduduk->golongan_darah == 'AB') {{ 'selected' }} @endif
                                                        value="AB">AB</option>
                                                    <option @if ($penduduk->golongan_darah == 'B') {{ 'selected' }} @endif
                                                        value="B">B</option>
                                                    <option @if ($penduduk->golongan_darah == 'O') {{ 'selected' }} @endif
                                                        value="O">O</option>
                                                    <option @if ($penduduk->golongan_darah == 'Tidak Tahu') {{ 'selected' }} @endif
                                                        value="Tidak Tahu">Tidak Tahu</option>
                                                </optgroup>
                                            </select>
                                        </div> <!-- golongan darah -->
                                        <div class="form-group col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="kewarganegaraan">Kewarganegaraan</label>
                                                <input type="text" id="kewarganegaraan"
                                                    class="form-control @error('kewarganegaraan') is-invalid @enderror"
                                                    value="{{ old('kewarganegaraan', $penduduk->kewarganegaraan) }}"
                                                    name="kewarganegaraan" placeholder="Kewarganegaraan" required>
                                                @error('kewarganegaraan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> <!-- kewarganegaraan -->
                                        <div class="form-group col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="suku">Etnis/Suku</label>
                                                <input type="text" id="suku"
                                                    class="form-control @error('suku') is-invalid @enderror"
                                                    value="{{ old('suku', $penduduk->suku) }}" name="suku"
                                                    placeholder="Etnis/Suku" required>
                                                @error('suku')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> <!-- etnis suku -->
                                        <div class="form-group col-md-6">
                                            <label for="select-pendidikan">Pendidikan </label>
                                            <select class="form-control select2" id="select-pendidikan"
                                                name="id_pendidikan">
                                                <optgroup label="-- Pendidikan --">
                                                    @foreach ($pendidikan as $pendidikan)
                                                        <option
                                                            @if ($penduduk->id_pendidikan == $pendidikan->id) {{ 'selected' }} @endif
                                                            value="{{ $pendidikan->id }}">
                                                            {{ $pendidikan->nama_pendidikan }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div> <!-- pendidikan -->
                                        <div class="form-group col-md-6">
                                            <label for="select-pekerjaan">Pekerjaan </label>
                                            <select class="form-control select2" id="select-pekerjaan"
                                                name="id_pekerjaan">
                                                <optgroup label="-- Pekerjaan --">
                                                    @foreach ($pekerjaan as $pekerjaan)
                                                        <option
                                                            @if ($penduduk->id_pekerjaan == $pekerjaan->id) {{ 'selected' }} @endif
                                                            value="{{ $pekerjaan->id }}">
                                                            {{ $pekerjaan->nama_pekerjaan }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div> <!-- pekerjaan -->
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary"><i class="fe fe-save"></i>
                                                Simpan</button>
                                        </div>
                                    </div>

                                </form><!-- End General Form Elements -->
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
