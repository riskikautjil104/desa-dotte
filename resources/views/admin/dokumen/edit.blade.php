@extends('admin.layouts.main', ['title' => 'Edit Dokumen'])

@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection

@section('main')
<div class="container-fluid">

    <h2 class="mb-3">Edit Dokumen</h2>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header">
            <strong>Form Edit Dokumen</strong>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.dokumen.update', $dokumen->id) }}" 
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ROW --}}
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label class="form-label">Nama Dokumen <span class="text-danger">*</span></label>
                        <input type="text" name="nama_dokumen" class="form-control"
                               value="{{ old('nama_dokumen', $dokumen->nama_dokumen) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Jenis Dokumen <span class="text-danger">*</span></label>
                        <select name="jenis_dokumen_id" class="form-select" required>
                            <option value="">-- Pilih Jenis --</option>
                            @foreach($jenisDokumens as $jenis)
                                <option value="{{ $jenis->id }}"
                                    {{ old('jenis_dokumen_id', $dokumen->jenis_dokumen_id) == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->nama_jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $dokumen->deskripsi) }}</textarea>
                </div>

                {{-- FILE --}}
                <div class="mb-3">
                    <label class="form-label">Ganti File (Opsional)</label>
                    <input type="file" name="file" class="form-control" id="fileInput">
                    <small class="text-muted">
                        Kosongkan jika tidak diganti. Maks 20MB.
                    </small>
                </div>

                {{-- FILE SAAT INI --}}
                <div class="mb-3">
                    <label class="form-label">File Saat Ini</label>
                    <div class="alert alert-info">
                        <i class="bi bi-file-earmark-text"></i>
                        <strong>{{ $dokumen->nama_file_asli }}</strong><br>
                        <small>Ukuran: {{ $dokumen->ukuran_file_formatted }}</small>
                    </div>
                </div>

                {{-- PREVIEW --}}
                <div class="mb-3 d-none" id="preview-file">
                    <label class="form-label">Preview File Baru</label>
                    <div id="preview-content"></div>
                </div>

                {{-- STATUS --}}
                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" name="is_published" value="1"
                        {{ old('is_published', $dokumen->is_published) ? 'checked' : '' }}>
                    <label class="form-check-label">Publikasikan</label>
                </div>

                {{-- BUTTON --}}
                <div class="d-flex gap-2">
                    <button class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection

@section('js')
<script>
document.getElementById('fileInput').addEventListener('change', function () {
    let file = this.files[0];
    if (!file) return;

    let size = (file.size / 1024 / 1024).toFixed(2) + ' MB';

    document.getElementById('preview-file').classList.remove('d-none');
    document.getElementById('preview-content').innerHTML = `
        <div class="alert alert-warning">
            <i class="bi bi-upload"></i>
            <strong>${file.name}</strong><br>
            Ukuran: ${size}<br>
            Tipe: ${file.type || 'Unknown'}
        </div>
    `;
});
</script>
@endsection
