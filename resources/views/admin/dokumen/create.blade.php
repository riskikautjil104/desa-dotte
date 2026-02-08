@extends('admin.layouts.main', ['title' => 'Tambah Dokumen'])

@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="mb-2 page-title">Tambah Dokumen Baru</h2>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Dokumen</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Nama Dokumen *</label>
                                    <input type="text" class="form-control" name="nama_dokumen"
                                           value="{{ old('nama_dokumen') }}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Jenis Dokumen *</label>
                                    <select name="jenis_dokumen_id" class="form-control" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        @foreach ($jenisDokumens as $jenis)
                                            <option value="{{ $jenis->id }}"
                                                {{ old('jenis_dokumen_id') == $jenis->id ? 'selected' : '' }}>
                                                {{ $jenis->nama_jenis }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>File Dokumen *</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file" id="file" required>
                                <label class="custom-file-label">Pilih file</label>
                            </div>
                            <small class="text-muted">
                                PDF, Word, Excel, PPT, ZIP, JPG, PNG (Max 20MB)
                            </small>
                        </div>

                        <div class="form-group" id="preview-file" style="display:none;">
                            <label>Preview File</label>
                            <div id="file-preview-content"></div>
                        </div>

                        <div class="custom-control custom-switch mb-4">
                            <input type="checkbox" class="custom-control-input"
                                   id="is_published" name="is_published" value="1" checked>
                            <label class="custom-control-label" for="is_published">
                                Publikasikan ke website
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fe fe-save"></i> Simpan Dokumen
                        </button>
                        <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary">
                            Batal
                        </a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
<script>
document.getElementById('file').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    document.querySelector('.custom-file-label').textContent = file.name;

    let size = file.size;
    let sizeText = size >= 1048576
        ? (size / 1048576).toFixed(2) + ' MB'
        : (size / 1024).toFixed(2) + ' KB';

    document.getElementById('preview-file').style.display = 'block';
    document.getElementById('file-preview-content').innerHTML = `
        <div class="alert alert-info">
            <strong>Nama:</strong> ${file.name}<br>
            <strong>Ukuran:</strong> ${sizeText}<br>
            <strong>Tipe:</strong> ${file.type || 'Unknown'}
        </div>`;
});
</script>
@endsection
