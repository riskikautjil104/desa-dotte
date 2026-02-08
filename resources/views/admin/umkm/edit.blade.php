@extends('admin.layouts.main',['title' => 'Edit UMKM'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h2 class="page-title">Edit UMKM</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.umkm.index') }}">UMKM</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('admin.umkm.index') }}" class="btn btn-secondary">
                            <i class="fe fe-arrow-left fe-16"></i> Kembali
                        </a>
                    </div>
                </div>

                <form action="{{ route('admin.umkm.update', $umkm->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Main Form -->
                        <div class="col-md-8">
                            <!-- Informasi Dasar -->
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">Informasi Dasar</strong>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama_usaha">Nama Usaha <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_usaha" id="nama_usaha" 
                                               class="form-control @error('nama_usaha') is-invalid @enderror" 
                                               value="{{ old('nama_usaha', $umkm->nama_usaha) }}" required>
                                        @error('nama_usaha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="pemilik">Nama Pemilik <span class="text-danger">*</span></label>
                                        <input type="text" name="pemilik" id="pemilik" 
                                               class="form-control @error('pemilik') is-invalid @enderror" 
                                               value="{{ old('pemilik', $umkm->pemilik) }}" required>
                                        @error('pemilik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="kategori">Kategori <span class="text-danger">*</span></label>
                                            <select name="kategori" id="kategori" 
                                                    class="form-control @error('kategori') is-invalid @enderror" required>
                                                <option value="">Pilih Kategori</option>
                                                <option value="makanan" {{ old('kategori', $umkm->kategori) == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                                <option value="minuman" {{ old('kategori', $umkm->kategori) == 'minuman' ? 'selected' : '' }}>Minuman</option>
                                                <option value="fashion" {{ old('kategori', $umkm->kategori) == 'fashion' ? 'selected' : '' }}>Fashion</option>
                                                <option value="jasa" {{ old('kategori', $umkm->kategori) == 'jasa' ? 'selected' : '' }}>Jasa</option>
                                                <option value="kerajinan" {{ old('kategori', $umkm->kategori) == 'kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                                                <option value="teknologi" {{ old('kategori', $umkm->kategori) == 'teknologi' ? 'selected' : '' }}>Teknologi</option>
                                                <option value="lainnya" {{ old('kategori', $umkm->kategori) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                            @error('kategori')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select name="status" id="status" 
                                                    class="form-control @error('status') is-invalid @enderror" required>
                                                <option value="aktif" {{ old('status', $umkm->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="verifikasi" {{ old('status', $umkm->status) == 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
                                                <option value="nonaktif" {{ old('status', $umkm->status) == 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                                            </select>
                                            @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                                        <textarea name="deskripsi" id="deskripsi" rows="6" 
                                                  class="form-control @error('deskripsi') is-invalid @enderror" 
                                                  required>{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Jelaskan produk/jasa yang ditawarkan</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Kontak & Lokasi -->
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">Kontak & Lokasi</strong>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat" id="alamat" rows="3" 
                                                  class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $umkm->alamat) }}</textarea>
                                        @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="no_hp">Nomor HP/WhatsApp <span class="text-danger">*</span></label>
                                            <input type="text" name="no_hp" id="no_hp" 
                                                   class="form-control @error('no_hp') is-invalid @enderror" 
                                                   value="{{ old('no_hp', $umkm->no_hp) }}" placeholder="08xxxxxxxxxx" required>
                                            @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" 
                                                   class="form-control @error('email') is-invalid @enderror" 
                                                   value="{{ old('email', $umkm->email) }}" placeholder="email@example.com">
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="instagram">Instagram</label>
                                            <input type="url" name="instagram" id="instagram" 
                                                   class="form-control @error('instagram') is-invalid @enderror" 
                                                   value="{{ old('instagram', $umkm->instagram) }}" placeholder="https://instagram.com/username">
                                            @error('instagram')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="facebook">Facebook</label>
                                            <input type="url" name="facebook" id="facebook" 
                                                   class="form-control @error('facebook') is-invalid @enderror" 
                                                   value="{{ old('facebook', $umkm->facebook) }}" placeholder="https://facebook.com/username">
                                            @error('facebook')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="latitude">Latitude</label>
                                            <input type="text" name="latitude" id="latitude" 
                                                   class="form-control @error('latitude') is-invalid @enderror" 
                                                   value="{{ old('latitude', $umkm->latitude) }}" placeholder="1.234567">
                                            @error('latitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="longitude">Longitude</label>
                                            <input type="text" name="longitude" id="longitude" 
                                                   class="form-control @error('longitude') is-invalid @enderror" 
                                                   value="{{ old('longitude', $umkm->longitude) }}" placeholder="124.123456">
                                            @error('longitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="fe fe-info"></i>
                                        Koordinat untuk peta lokasi (opsional). Bisa didapat dari Google Maps.
                                    </small>
                                </div>
                            </div>

                            <!-- Media -->
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">Gambar & Galeri</strong>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="gambar_utama">Gambar Utama</label>
                                        
                                        @if($umkm->gambar_utama)
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/umkm/' . $umkm->gambar_utama) }}" 
                                                 alt="{{ $umkm->nama_usaha }}" 
                                                 class="img-fluid rounded" 
                                                 style="max-height: 200px;">
                                            <div class="form-text text-muted">Gambar saat ini</div>
                                        </div>
                                        @endif
                                        
                                        <input type="file" name="gambar_utama" id="gambar_utama" 
                                               class="form-control-file @error('gambar_utama') is-invalid @enderror" 
                                               accept="image/*" onchange="previewImage(this, 'preview-utama')">
                                        @error('gambar_utama')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Format: JPG, PNG, GIF. Maks: 2MB. Kosongkan jika tidak ingin mengubah.</small>
                                        <div id="preview-utama" class="mt-3"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="galeri">Galeri Foto (Multiple)</label>
                                        
                                        @php
                                            // Safe decode galeri
                                            $galeriArray = [];
                                            if ($umkm->galeri) {
                                                if (is_string($umkm->galeri)) {
                                                    $galeriArray = json_decode($umkm->galeri, true) ?? [];
                                                } elseif (is_array($umkm->galeri)) {
                                                    $galeriArray = $umkm->galeri;
                                                }
                                            }
                                        @endphp
                                        
                                        @if(!empty($galeriArray))
                                        <div class="row mb-3">
                                            @foreach($galeriArray as $foto)
                                            <div class="col-md-3 col-6 mb-3">
                                                <img src="{{ asset('storage/umkm/galeri/' . $foto) }}" 
                                                     class="img-fluid rounded" 
                                                     style="height: 100px; object-fit: cover; width: 100%;">
                                            </div>
                                            @endforeach
                                            <div class="col-12">
                                                <small class="text-muted">Galeri foto saat ini</small>
                                            </div>
                                        </div>
                                        @endif
                                        
                                        <input type="file" name="galeri[]" id="galeri" 
                                               class="form-control-file @error('galeri') is-invalid @enderror" 
                                               accept="image/*" multiple onchange="previewMultipleImages(this, 'preview-galeri')">
                                        @error('galeri')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Bisa pilih beberapa gambar sekaligus. Maks per file: 2MB. Upload baru akan mengganti galeri lama.</small>
                                        <div id="preview-galeri" class="row mt-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="col-md-4">
                            <!-- Statistik -->
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">Statistik</strong>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Total Views</span>
                                        <strong>{{ $umkm->views }}</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Dibuat</span>
                                        <strong>{{ $umkm->created_at->format('d M Y') }}</strong>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Terakhir Update</span>
                                        <strong>{{ $umkm->updated_at->format('d M Y') }}</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Pengaturan -->
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">Pengaturan</strong>
                                </div>
                                <div class="card-body">
                                    <div class="custom-control custom-switch mb-3">
                                        <input type="checkbox" class="custom-control-input" 
                                               name="is_featured" id="is_featured" value="1" 
                                               {{ old('is_featured', $umkm->is_featured) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_featured">
                                            <i class="fe fe-star text-warning"></i> Jadikan UMKM Unggulan
                                        </label>
                                        <small class="form-text text-muted">
                                            UMKM unggulan akan ditampilkan di halaman utama
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Card -->
                            <div class="card shadow mb-4">
                                <div class="card-body bg-light">
                                    <h6 class="mb-3">
                                        <i class="fe fe-info text-primary"></i> Informasi
                                    </h6>
                                    <ul class="small text-muted pl-3">
                                        <li>Field dengan tanda <span class="text-danger">*</span> wajib diisi</li>
                                        <li>Gambar baru akan mengganti gambar lama</li>
                                        <li>Kosongkan field gambar jika tidak ingin mengubah</li>
                                        <li>Pastikan data yang diinput sudah benar</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="card shadow">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary btn-block mb-2">
                                        <i class="fe fe-save"></i> Update UMKM
                                    </button>
                                    <a href="{{ route('admin.umkm.index') }}" class="btn btn-secondary btn-block mb-2">
                                        <i class="fe fe-x-circle"></i> Batal
                                    </a>
                                    <button type="button" class="btn btn-danger btn-block" onclick="confirmDelete()">
                                        <i class="fe fe-trash-2"></i> Hapus UMKM
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Delete Form -->
                <form id="delete-form" action="{{ route('admin.umkm.destroy', $umkm->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>

    <script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        preview.innerHTML = '';
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded" style="max-height: 200px;">`;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewMultipleImages(input, previewId) {
        const preview = document.getElementById(previewId);
        preview.innerHTML = '';
        
        if (input.files) {
            Array.from(input.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-4 col-6 mb-3';
                    col.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded" style="height: 100px; object-fit: cover; width: 100%;">`;
                    preview.appendChild(col);
                }
                reader.readAsDataURL(file);
            });
        }
    }

    function confirmDelete() {
        if (confirm('Apakah Anda yakin ingin menghapus UMKM ini? Tindakan ini tidak dapat dibatalkan!')) {
            document.getElementById('delete-form').submit();
        }
    }
    </script>
@endsection