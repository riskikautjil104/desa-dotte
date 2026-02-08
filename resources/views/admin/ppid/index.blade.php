@extends('admin.layouts.main', ['title' => 'PPID'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
@endsection

@section('content')
<div class="container-fluid">
   <!-- Page Header -->
   <div class="row">
      <div class="col-12">
         <div class="page-header d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title mb-0">Manajemen PPID (Pejabat Pengelola Informasi dan Dokumentasi)</h4>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPPIDModal">
               <i class="fe fe-plus"></i> Tambah Data PPID
            </button>
         </div>
      </div>
   </div>

   <!-- Stats Cards -->
   <div class="row mb-4">
      <div class="col-md-4">
         <div class="card border-0 shadow-sm">
            <div class="card-body">
               <div class="row align-items-center">
                  <div class="col">
                     <h5 class="card-title text-muted mb-0">Total Data PPID</h5>
                     <h2 class="mb-0 text-primary">{{ $totalPPID }}</h2>
                  </div>
                  <div class="col-auto">
                     <div class="icon-shape bg-primary text-white rounded-circle p-3">
                        <i class="fe fe-file-text fe-24"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
      <div class="col-md-4">
         <div class="card border-0 shadow-sm">
            <div class="card-body">
               <div class="row align-items-center">
                  <div class="col">
                     <h5 class="card-title text-muted mb-0">Informasi Berkala</h5>
                     <h2 class="mb-0 text-success">{{ $totalBerkala }}</h2>
                  </div>
                  <div class="col-auto">
                     <div class="icon-shape bg-success text-white rounded-circle p-3">
                        <i class="fe fe-clock fe-24"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
      <div class="col-md-4">
         <div class="card border-0 shadow-sm">
            <div class="card-body">
               <div class="row align-items-center">
                  <div class="col">
                     <h5 class="card-title text-muted mb-0">Informasi Serta Merta</h5>
                     <h2 class="mb-0 text-info">{{ $totalSertaMerta }}</h2>
                  </div>
                  <div class="col-auto">
                     <div class="icon-shape bg-info text-white rounded-circle p-3">
                        <i class="fe fe-bell fe-24"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Data Table -->
   <div class="row">
      <div class="col-12">
         <div class="card border-0 shadow-sm">
            <div class="card-header">
               <h5 class="card-title mb-0">Data PPID Desa</h5>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-hover" id="dataTable">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Judul</th>
                           <th>Kategori</th>
                           <th>Deskripsi</th>
                           <th>File</th>
                           <th>Tanggal Publikasi</th>
                           <th>Status</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse($ppidData as $index => $ppid)
                        <tr>
                           <td>{{ $index + 1 }}</td>
                           <td><strong>{{ $ppid->judul }}</strong></td>
                           <td>
                              <span class="badge badge-info">
                                 <i class="bi {{ $ppid->kategori_icon }} me-1"></i>
                                 {{ $ppid->kategori_label }}
                              </span>
                           </td>
                           <td>{{ Str::limit($ppid->deskripsi, 50) }}</td>
                           <td>
                              @if($ppid->file_path)
                              <a href="{{ asset('storage/' . $ppid->file_path) }}"
                                 target="_blank" class="btn btn-sm btn-outline-primary">
                                 <i class="fe fe-download"></i> Unduh
                              </a>
                              @else
                              <span class="text-muted">-</span>
                              @endif
                           </td>
                           <td>{{ $ppid->tanggal_publikasi->format('d/m/Y') }}</td>
                           <td>
                              @if($ppid->status)
                              <span class="badge badge-success">Aktif</span>
                              @else
                              <span class="badge badge-secondary">Nonaktif</span>
                              @endif
                           </td>
                           <td>
                              <button type="button" class="btn btn-sm btn-outline-primary"
                                 onclick="editPPID({{ $ppid->id }})">
                                 <i class="fe fe-edit"></i>
                              </button>
                              <button type="button" class="btn btn-sm btn-outline-danger"
                                 onclick="deletePPID({{ $ppid->id }})">
                                 <i class="fe fe-trash"></i>
                              </button>
                           </td>
                        </tr>
                        @empty
                        <tr>
                           <td colspan="8" class="text-center py-4">
                              <i class="fe fe-folder-open fe-48 text-muted mb-3 d-block"></i>
                              <p class="text-muted mb-0">Belum ada data PPID</p>
                           </td>
                        </tr>
                        @endforelse
                     </tbody>
                  </table>
               </div>
               <!-- Pagination -->
               <div class="mt-3">
                  {{ $ppidData->links() }}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Add PPID Modal -->
<div class="modal fade" id="addPPIDModal" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Tambah Data PPID</h5>
            <button type="button" class="close" data-dismiss="modal">
               <span>×</span>
            </button>
         </div>
         <form action="{{ route('admin.ppid.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label>Judul <span class="text-danger">*</span></label>
                  <input type="text" name="judul" class="form-control" required>
               </div>
               <div class="form-group">
                  <label>Kategori <span class="text-danger">*</span></label>
                  <select name="kategori" class="form-control" required>
                     <option value="">Pilih Kategori</option>
                     <option value="informasiBerkala">Informasi Berkala</option>
                     <option value="informasiSertaMerta">Informasi Serta Merta</option>
                     <option value="informasiSetiapSaat">Informasi Setiap Saat</option>
                     <option value="informasiDikecualikan">Informasi Dikecualikan</option>
                     <option value="laporan">Laporan</option>
                     <option value="dokumen">Dokumen</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi informasi PPID..."></textarea>
               </div>
               <div class="form-group">
                  <label>File (PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX)</label>
                  <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                  <small class="form-text text-muted">Maksimal ukuran: 10MB</small>
               </div>
               <div class="form-group">
                  <label>Tanggal Publikasi</label>
                  <input type="date" name="tanggal_publikasi" class="form-control" value="{{ date('Y-m-d') }}">
               </div>
               <div class="form-group">
                  <div class="custom-control custom-checkbox">
                     <input type="checkbox" class="custom-control-input" id="status" name="status" checked>
                     <label class="custom-control-label" for="status">Data Aktif</label>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
               <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Edit PPID Modal -->
<div class="modal fade" id="editPPIDModal" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Edit Data PPID</h5>
            <button type="button" class="close" data-dismiss="modal">
               <span>×</span>
            </button>
         </div>
         <form id="editPPIDForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body">
               <div class="form-group">
                  <label>Judul <span class="text-danger">*</span></label>
                  <input type="text" name="judul" id="edit_judul" class="form-control" required>
               </div>
               <div class="form-group">
                  <label>Kategori <span class="text-danger">*</span></label>
                  <select name="kategori" id="edit_kategori" class="form-control" required>
                     <option value="informasiBerkala">Informasi Berkala</option>
                     <option value="informasiSertaMerta">Informasi Serta Merta</option>
                     <option value="informasiSetiapSaat">Informasi Setiap Saat</option>
                     <option value="informasiDikecualikan">Informasi Dikecualikan</option>
                     <option value="laporan">Laporan</option>
                     <option value="dokumen">Dokumen</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea name="deskripsi" id="edit_deskripsi" class="form-control" rows="3"></textarea>
               </div>
               <div class="form-group">
                  <label>File Baru (opsional)</label>
                  <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                  <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah file</small>
               </div>
               <div class="form-group">
                  <label>Tanggal Publikasi</label>
                  <input type="date" name="tanggal_publikasi" id="edit_tanggal_publikasi" class="form-control">
               </div>
               <div class="form-group">
                  <div class="custom-control custom-checkbox">
                     <input type="checkbox" class="custom-control-input" id="edit_status" name="status">
                     <label class="custom-control-label" for="edit_status">Data Aktif</label>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
               <button type="submit" class="btn btn-primary">Update</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
   // Initialize DataTable
   $('#dataTable').DataTable({
      "language": {
         "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
      }
   });
});

function editPPID(id) {
   // Fetch data PPID untuk diedit
   fetch(`/administrator/dashboard/ppid/${id}/edit`)
      .then(response => response.json())
      .then(data => {
         document.getElementById('edit_judul').value = data.judul;
         document.getElementById('edit_kategori').value = data.kategori;
         document.getElementById('edit_deskripsi').value = data.deskripsi || '';
         document.getElementById('edit_tanggal_publikasi').value = data.tanggal_publikasi ? data.tanggal_publikasi.split(' ')[0] : '';
         document.getElementById('edit_status').checked = data.status;

         document.getElementById('editPPIDForm').action = `/administrator/dashboard/ppid/${id}`;
         $('#editPPIDModal').modal('show');
      })
      .catch(error => {
         console.error('Error:', error);
         alert('Gagal memuat data PPID');
      });
}

function deletePPID(id) {
   if (confirm('Apakah Anda yakin ingin menghapus data PPID ini?')) {
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = `/administrator/dashboard/ppid/${id}`;

      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                        document.querySelector('input[name="_token"]')?.value;
      
      const methodField = document.createElement('input');
      methodField.type = 'hidden';
      methodField.name = '_method';
      methodField.value = 'DELETE';

      const csrfField = document.createElement('input');
      csrfField.type = 'hidden';
      csrfField.name = '_token';
      csrfField.value = csrfToken;

      form.appendChild(methodField);
      form.appendChild(csrfField);

      document.body.appendChild(form);
      form.submit();
   }
}
</script>
@endpush