@extends('admin.layouts.main', ['title' => 'Edit Penduduk Sementara'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Edit Data Penduduk Sementara</h2>
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <form action="{{ route('penduduk-sementara.update', $sementara) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Data Pribadi -->
                                    <h5 class="mb-3 border-bottom pb-2">Data Pribadi (Biodata)</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nik">Nomor Induk Kependudukan (NIK)</label>
                                                <input type="text"
                                                    class="form-control @error('nik') is-invalid @enderror" id="nik"
                                                    name="nik" value="{{ old('nik', $sementara->nik) }}"
                                                    required>
                                                @error('nik')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama">Nama Lengkap</label>
                                                <input type="text"
                                                    class="form-control @error('nama') is-invalid @enderror" id="nama"
                                                    name="nama" value="{{ old('nama', $sementara->nama) }}"
                                                    required>
                                                @error('nama')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                                    id="jenis_kelamin" name="jenis_kelamin" required>
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option value="LAKI-LAKI"
                                                        {{ old('jenis_kelamin', $sementara->jenis_kelamin) == 'LAKI-LAKI' ? 'selected' : '' }}>
                                                        LAKI-LAKI</option>
                                                    <option value="PEREMPUAN"
                                                        {{ old('jenis_kelamin', $sementara->jenis_kelamin) == 'PEREMPUAN' ? 'selected' : '' }}>
                                                        PEREMPUAN</option>
                                                </select>
                                                @error('jenis_kelamin')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text"
                                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                    id="tempat_lahir" name="tempat_lahir"
                                                    value="{{ old('tempat_lahir', $sementara->tempat_lahir) }}"
                                                    required>
                                                @error('tempat_lahir')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date"
                                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                    id="tanggal_lahir" name="tanggal_lahir"
                                                    value="{{ old('tanggal_lahir', $sementara->tanggal_lahir->format('Y-m-d')) }}"
                                                    required>
                                                @error('tanggal_lahir')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="agama">Agama/Kepercayaan</label>
                                                <select class="form-control @error('agama') is-invalid @enderror"
                                                    id="agama" name="agama" required>
                                                    <option value="">Pilih Agama</option>
                                                    <option value="ISLAM"
                                                        {{ old('agama', $sementara->agama) == 'ISLAM' ? 'selected' : '' }}>
                                                        ISLAM</option>
                                                    <option value="KRISTEN"
                                                        {{ old('agama', $sementara->agama) == 'KRISTEN' ? 'selected' : '' }}>
                                                        KRISTEN</option>
                                                    <option value="KATOLIK"
                                                        {{ old('agama', $sementara->agama) == 'KATOLIK' ? 'selected' : '' }}>
                                                        KATOLIK</option>
                                                    <option value="HINDU"
                                                        {{ old('agama', $sementara->agama) == 'HINDU' ? 'selected' : '' }}>
                                                        HINDU</option>
                                                    <option value="BUDHA"
                                                        {{ old('agama', $sementara->agama) == 'BUDHA' ? 'selected' : '' }}>
                                                        BUDHA</option>
                                                    <option value="KONGHUCU"
                                                        {{ old('agama', $sementara->agama) == 'KONGHUCU' ? 'selected' : '' }}>
                                                        KONGHUCU</option>
                                                </select>
                                                @error('agama')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status_perkawinan">Status Perkawinan</label>
                                                <select
                                                    class="form-control @error('status_perkawinan') is-invalid @enderror"
                                                    id="status_perkawinan" name="status_perkawinan" required>
                                                    <option value="">Pilih Status</option>
                                                    <option value="BELUM KAWIN"
                                                        {{ old('status_perkawinan', $sementara->status_perkawinan) == 'BELUM KAWIN' ? 'selected' : '' }}>
                                                        BELUM KAWIN</option>
                                                    <option value="KAWIN"
                                                        {{ old('status_perkawinan', $sementara->status_perkawinan) == 'KAWIN' ? 'selected' : '' }}>
                                                        KAWIN</option>
                                                    <option value="CERAI HIDUP"
                                                        {{ old('status_perkawinan', $sementara->status_perkawinan) == 'CERAI HIDUP' ? 'selected' : '' }}>
                                                        CERAI HIDUP</option>
                                                    <option value="CERAI MATI"
                                                        {{ old('status_perkawinan', $sementara->status_perkawinan) == 'CERAI MATI' ? 'selected' : '' }}>
                                                        CERAI MATI</option>
                                                </select>
                                                @error('status_perkawinan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                                <select
                                                    class="form-control @error('pendidikan_terakhir') is-invalid @enderror"
                                                    id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                                                    <option value="">Pilih Pendidikan</option>
                                                    <option value="SD"
                                                        {{ old('pendidikan_terakhir', $sementara->pendidikan_terakhir) == 'SD' ? 'selected' : '' }}>
                                                        SD</option>
                                                    <option value="SMP"
                                                        {{ old('pendidikan_terakhir', $sementara->pendidikan_terakhir) == 'SMP' ? 'selected' : '' }}>
                                                        SMP</option>
                                                    <option value="SMA/SMK"
                                                        {{ old('pendidikan_terakhir', $sementara->pendidikan_terakhir) == 'SMA/SMK' ? 'selected' : '' }}>
                                                        SMA/SMK</option>
                                                    <option value="D1"
                                                        {{ old('pendidikan_terakhir', $sementara->pendidikan_terakhir) == 'D1' ? 'selected' : '' }}>
                                                        D1</option>
                                                    <option value="D2"
                                                        {{ old('pendidikan_terakhir', $sementara->pendidikan_terakhir) == 'D2' ? 'selected' : '' }}>
                                                        D2</option>
                                                    <option value="D3"
                                                        {{ old('pendidikan_terakhir', $sementara->pendidikan_terakhir) == 'D3' ? 'selected' : '' }}>
                                                        D3</option>
                                                    <option value="S1"
                                                        {{ old('pendidikan_terakhir', $sementara->pendidikan_terakhir) == 'S1' ? 'selected' : '' }}>
                                                        S1</option>
                                                    <option value="S2"
                                                        {{ old('pendidikan_terakhir', $sementara->pendidikan_terakhir) == 'S2' ? 'selected' : '' }}>
                                                        S2</option>
                                                    <option value="S3"
                                                        {{ old('pendidikan_terakhir', $sementara->pendidikan_terakhir) == 'S3' ? 'selected' : '' }}>
                                                        S3</option>
                                                </select>
                                                @error('pendidikan_terakhir')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="jenis_pekerjaan">Jenis Pekerjaan</label>
                                                <input type="text"
                                                    class="form-control @error('jenis_pekerjaan') is-invalid @enderror"
                                                    id="jenis_pekerjaan" name="jenis_pekerjaan"
                                                    value="{{ old('jenis_pekerjaan', $sementara->jenis_pekerjaan) }}"
                                                    required>
                                                @error('jenis_pekerjaan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <!-- Data Domisili -->
                                    <h5 class="mb-3 border-bottom pb-2">Data Domisili/Alamat</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="alamat_asal">Alamat Asal</label>
                                                <textarea class="form-control @error('alamat_asal') is-invalid @enderror" id="alamat_asal" name="alamat_asal"
                                                    rows="3" required>{{ old('alamat_asal', $sementara->alamat_asal) }}</textarea>
                                                @error('alamat_asal')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="alamat_sementara">Alamat Domisili Sementara</label>
                                                <textarea class="form-control @error('alamat_sementara') is-invalid @enderror" id="alamat_sementara"
                                                    name="alamat_sementara" rows="3" required>{{ old('alamat_sementara', $sementara->alamat_sementara) }}</textarea>
                                                @error('alamat_sementara')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tujuan_tinggal">Tujuan Tinggal</label>
                                                <select class="form-control @error('tujuan_tinggal') is-invalid @enderror"
                                                    id="tujuan_tinggal" name="tujuan_tinggal" required>
                                                    <option value="">Pilih Tujuan</option>
                                                    <option value="Bekerja"
                                                        {{ old('tujuan_tinggal', $sementara->tujuan_tinggal) == 'Bekerja' ? 'selected' : '' }}>
                                                        Bekerja</option>
                                                    <option value="Studi"
                                                        {{ old('tujuan_tinggal', $sementara->tujuan_tinggal) == 'Studi' ? 'selected' : '' }}>
                                                        Studi</option>
                                                    <option value="Keluarga"
                                                        {{ old('tujuan_tinggal', $sementara->tujuan_tinggal) == 'Keluarga' ? 'selected' : '' }}>
                                                        Keluarga</option>
                                                    <option value="Usaha"
                                                        {{ old('tujuan_tinggal', $sementara->tujuan_tinggal) == 'Usaha' ? 'selected' : '' }}>
                                                        Usaha</option>
                                                    <option value="Lainnya"
                                                        {{ old('tujuan_tinggal', $sementara->tujuan_tinggal) == 'Lainnya' ? 'selected' : '' }}>
                                                        Lainnya</option>
                                                </select>
                                                @error('tujuan_tinggal')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="estimasi_waktu">Estimasi Waktu Tinggal</label>
                                                <input type="text"
                                                    class="form-control @error('estimasi_waktu') is-invalid @enderror"
                                                    id="estimasi_waktu" name="estimasi_waktu"
                                                    value="{{ old('estimasi_waktu', $sementara->estimasi_waktu) }}"
                                                    required>
                                                @error('estimasi_waktu')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <!-- Dokumen Pendukung -->
                                    <h5 class="mb-3 border-bottom pb-2">Dokumen Pendukung</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ktp">Fotokopi KTP-el Asli</label>
                                                @if ($sementara->ktp_path)
                                                    <div class="mb-2">
                                                        <a href="{{ Storage::url($sementara->ktp_path) }}"
                                                            target="_blank" class="btn btn-sm btn-info">
                                                            <i class="fe fe-file"></i> Lihat Dokumen Lama
                                                        </a>
                                                    </div>
                                                @endif
                                                <input type="file"
                                                    class="form-control-file @error('ktp') is-invalid @enderror"
                                                    id="ktp" name="ktp" accept=".pdf,.jpg,.jpeg,.png">
                                                <small class="text-muted">Format: PDF, JPG, PNG (Max 2MB) - Biarkan kosong
                                                    jika tidak diubah</small>
                                                @error('ktp')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kk">Fotokopi Kartu Keluarga (KK)</label>
                                                @if ($sementara->kk_path)
                                                    <div class="mb-2">
                                                        <a href="{{ Storage::url($sementara->kk_path) }}"
                                                            target="_blank" class="btn btn-sm btn-info">
                                                            <i class="fe fe-file"></i> Lihat Dokumen Lama
                                                        </a>
                                                    </div>
                                                @endif
                                                <input type="file"
                                                    class="form-control-file @error('kk') is-invalid @enderror"
                                                    id="kk" name="kk" accept=".pdf,.jpg,.jpeg,.png">
                                                <small class="text-muted">Format: PDF, JPG, PNG (Max 2MB) - Biarkan kosong
                                                    jika tidak diubah</small>
                                                @error('kk')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="surat_pengantar">Surat Pengantar RT/RW</label>
                                                @if ($sementara->surat_pengantar_path)
                                                    <div class="mb-2">
                                                        <a href="{{ Storage::url($sementara->surat_pengantar_path) }}"
                                                            target="_blank" class="btn btn-sm btn-info">
                                                            <i class="fe fe-file"></i> Lihat Dokumen Lama
                                                        </a>
                                                    </div>
                                                @endif
                                                <input type="file"
                                                    class="form-control-file @error('surat_pengantar') is-invalid @enderror"
                                                    id="surat_pengantar" name="surat_pengantar"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                <small class="text-muted">Format: PDF, JPG, PNG (Max 2MB) - Biarkan kosong
                                                    jika tidak diubah</small>
                                                @error('surat_pengantar')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pas_foto">Pas Foto</label>
                                                @if ($sementara->pas_foto_path)
                                                    <div class="mb-2">
                                                        <a href="{{ Storage::url($sementara->pas_foto_path) }}"
                                                            target="_blank" class="btn btn-sm btn-info">
                                                            <i class="fe fe-image"></i> Lihat Foto Lama
                                                        </a>
                                                    </div>
                                                @endif
                                                <input type="file"
                                                    class="form-control-file @error('pas_foto') is-invalid @enderror"
                                                    id="pas_foto" name="pas_foto" accept=".jpg,.jpeg,.png">
                                                <small class="text-muted">Ukuran 3x4 atau 4x6 (Max 1MB) - Biarkan
                                                    kosong jika tidak diubah</small>
                                                @error('pas_foto')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fe fe-save"></i> Update Data
                                        </button>
                                        <a href="{{ route('penduduk-sementara.index') }}" class="btn btn-secondary">
                                            <i class="fe fe-arrow-left"></i> Kembali
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection