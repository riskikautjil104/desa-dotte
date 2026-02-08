{{-- resources/views/admin/agenda/create.blade.php --}}
@extends('admin.layouts.main',['title' => 'Tambah Agenda'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Tambah Agenda</h2>
                <p class="card-text">Tambahkan agenda atau kegiatan baru</p>

                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <form action="{{ route('admin.agenda.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="row">
                                        <!-- Judul -->
                                        <div class="col-md-12 mb-3">
                                            <label for="judul">Judul Agenda <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                                   id="judul" name="judul" value="{{ old('judul') }}" required>
                                            @error('judul')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Deskripsi -->
                                        <div class="col-md-12 mb-3">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                                      id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi') }}</textarea>
                                            @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Tanggal Mulai -->
                                        <div class="col-md-6 mb-3">
                                            <label for="tanggal_mulai">Tanggal Mulai <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                                   id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                                            @error('tanggal_mulai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Tanggal Selesai -->
                                        <div class="col-md-6 mb-3">
                                            <label for="tanggal_selesai">Tanggal Selesai</label>
                                            <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                                   id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                                            @error('tanggal_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">Kosongkan jika agenda hanya 1 hari</small>
                                        </div>

                                        <!-- Jam Mulai -->
                                        <div class="col-md-6 mb-3">
                                            <label for="jam_mulai">Jam Mulai</label>
                                            <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" 
                                                   id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}">
                                            @error('jam_mulai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Jam Selesai -->
                                        <div class="col-md-6 mb-3">
                                            <label for="jam_selesai">Jam Selesai</label>
                                            <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" 
                                                   id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}">
                                            @error('jam_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Lokasi -->
                                        <div class="col-md-6 mb-3">
                                            <label for="lokasi">Lokasi</label>
                                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                                   id="lokasi" name="lokasi" value="{{ old('lokasi') }}" 
                                                   placeholder="Contoh: Kantor Desa">
                                            @error('lokasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Pembicara -->
                                        <div class="col-md-6 mb-3">
                                            <label for="pembicara">Pembicara/Narasumber</label>
                                            <input type="text" class="form-control @error('pembicara') is-invalid @enderror" 
                                                   id="pembicara" name="pembicara" value="{{ old('pembicara') }}" 
                                                   placeholder="Contoh: Kepala Desa">
                                            @error('pembicara')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Kategori -->
                                        <div class="col-md-4 mb-3">
                                            <label for="kategori">Kategori <span class="text-danger">*</span></label>
                                            <select class="form-control @error('kategori') is-invalid @enderror" 
                                                    id="kategori" name="kategori" required>
                                                <option value="">Pilih Kategori</option>
                                                <option value="umum" {{ old('kategori') == 'umum' ? 'selected' : '' }}>Umum</option>
                                                <option value="rapat" {{ old('kategori') == 'rapat' ? 'selected' : '' }}>Rapat</option>
                                                <option value="seleksi" {{ old('kategori') == 'seleksi' ? 'selected' : '' }}>Seleksi</option>
                                                <option value="acara_budaya" {{ old('kategori') == 'acara_budaya' ? 'selected' : '' }}>Acara Budaya</option>
                                                <option value="seminar" {{ old('kategori') == 'seminar' ? 'selected' : '' }}>Seminar</option>
                                            </select>
                                            @error('kategori')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-4 mb-3">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select class="form-control @error('status') is-invalid @enderror" 
                                                    id="status" name="status" required>
                                                <option value="">Pilih Status</option>
                                                <option value="akan_datang" {{ old('status') == 'akan_datang' ? 'selected' : '' }}>Akan Datang</option>
                                                <option value="sedang_berlangsung" {{ old('status') == 'sedang_berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
                                                <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                            @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Is Published -->
                                        <div class="col-md-4 mb-3">
                                            <label for="is_published">Publikasi</label>
                                            <div class="custom-control custom-switch mt-2">
                                                <input type="checkbox" class="custom-control-input" 
                                                       id="is_published" name="is_published" value="1" 
                                                       {{ old('is_published', true) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="is_published">
                                                    Publikasikan agenda
                                                </label>
                                            </div>
                                            <small class="form-text text-muted">Jika tidak dicentang, agenda akan disimpan sebagai draft</small>
                                        </div>

                                        <!-- Gambar -->
                                        <div class="col-md-12 mb-3">
                                            <label for="gambar">Gambar Agenda</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @error('gambar') is-invalid @enderror" 
                                                       id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
                                                <label class="custom-file-label" for="gambar">Pilih gambar...</label>
                                                @error('gambar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <small class="form-text text-muted">Format: JPG, JPEG, PNG, GIF, SVG. Maksimal 2MB</small>
                                            
                                            <!-- Preview Image -->
                                            <div id="imagePreview" class="mt-3" style="display: none;">
                                                <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fe fe-save"></i> Simpan Agenda
                                        </button>
                                        <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">
                                            <i class="fe fe-x"></i> Batal
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

    @push('scripts')
    <script>
        // Preview image before upload
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            const previewDiv = document.getElementById('imagePreview');
            const label = input.nextElementSibling;
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewDiv.style.display = 'block';
                }
                
                reader.readAsDataURL(input.files[0]);
                label.textContent = input.files[0].name;
            }
        }

        // Auto-fill tanggal selesai when tanggal mulai is selected
        document.getElementById('tanggal_mulai').addEventListener('change', function() {
            const tanggalSelesai = document.getElementById('tanggal_selesai');
            if (!tanggalSelesai.value) {
                tanggalSelesai.value = this.value;
            }
        });
    </script>
    @endpush
@endsection