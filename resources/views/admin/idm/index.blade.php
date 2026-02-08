@extends('admin.layouts.main',['title' => 'idm'])
@section('headerside')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')

@section('content')
<div class="container-fluid">
   <!-- Page Header -->
   <div class="row">
      <div class="col-12">
         <div class="page-header d-flex justify-content-between align-items-center mb-4">
            <h4 class="page-title mb-0">Manajemen IDM (Indeks Desa Membangun)</h4>
            <button type="button" class="btn" data-toggle="modal" data-target="#addIDMModal" style="background-color: #0dcdbd; color: white;">
               <i class="fe fe-plus"></i> Tambah Data IDM
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
                     <h5 class="card-title text-muted mb-0">Total Data IDM</h5>
                     <h2 class="mb-0" style="color: #0dcdbd;">{{ $totalIDM }}</h2>
                  </div>
                  <div class="col-auto">
                     <div class="icon-shape text-white rounded-circle p-3" style="background-color: #0dcdbd;">
                        <i class="fe fe-bar-chart-2 fe-24"></i>
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
                     <h5 class="card-title text-muted mb-0">Nilai IDM Saat Ini</h5>
                     <h2 class="mb-0 text-success">{{ $nilaiIDM }}</h2>
                  </div>
                  <div class="col-auto">
                     <div class="icon-shape bg-success text-white rounded-circle p-3">
                        <i class="fe fe-trending-up fe-24"></i>
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
                     <h5 class="card-title text-muted mb-0">Status</h5>
                     <h4 class="mb-0">
                        @if($nilaiIDM >= 70)
                        <span class="badge badge-success">Maju</span>
                        @elseif($nilaiIDM >= 50)
                        <span class="badge badge-warning">Berkembang</span>
                        @else
                        <span class="badge badge-danger">Tertinggal</span>
                        @endif
                     </h4>
                  </div>
                  <div class="col-auto">
                     <div class="icon-shape bg-info text-white rounded-circle p-3">
                        <i class="fe fe-info fe-24"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Chart Section -->
   @if(count($chartYears) > 0)
   <div class="row mb-4">
      <div class="col-12">
         <div class="card border-0 shadow-sm">
            <div class="card-header">
               <h5 class="card-title mb-0">Grafik Perkembangan IDM</h5>
            </div>
            <div class="card-body">
               <canvas id="idmChart" height="100"></canvas>
            </div>
         </div>
      </div>
   </div>
   @endif

   <!-- Data Table -->
   <div class="row">
      <div class="col-12">
         <div class="card border-0 shadow-sm">
            <div class="card-header">
               <h5 class="card-title mb-0">Data IDM Desa</h5>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-hover" id="dataTable">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Tahun</th>
                           <th>Skor IDM</th>
                           <th>Status</th>
                           <th>Deskripsi</th>
                           <th>Tanggal Input</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse($idmData as $index => $idm)
                        <tr>
                           <td>{{ $index + 1 }}</td>
                           <td><strong>{{ $idm->tahun }}</strong></td>
                           <td>
                              <span class="badge badge-{{ $idm->skor >= 70 ? 'success' : ($idm->skor >= 50 ? 'warning' : 'danger') }}">
                                 {{ $idm->skor }}
                              </span>
                           </td>
                           <td>
                              @if($idm->status)
                              <span class="badge badge-success">Aktif</span>
                              @else
                              <span class="badge badge-secondary">Nonaktif</span>
                              @endif
                           </td>
                           <td>{{ Str::limit($idm->deskripsi, 50) }}</td>
                           <td>{{ $idm->created_at->format('d/m/Y') }}</td>
                           <td>
                              <button type="button" class="btn btn-sm btn-outline-primary" onclick="editIDM({{ $idm->id }})">
                                 <i class="fe fe-edit"></i>
                              </button>
                              <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteIDM({{ $idm->id }})">
                                 <i class="fe fe-trash"></i>
                              </button>
                           </td>
                        </tr>
                        @empty
                        <tr>
                           <td colspan="7" class="text-center py-4">
                              <i class="fe fe-bar-chart fe-48 text-muted mb-3 d-block"></i>
                              <p class="text-muted mb-0">Belum ada data IDM</p>
                           </td>
                        </tr>
                        @endforelse
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Add IDM Modal -->
<div class="modal fade" id="addIDMModal" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Tambah Data IDM</h5>
            <button type="button" class="close" data-dismiss="modal">
               <span>×</span>
            </button>
         </div>
         <form action="{{ route('admin.idm.store') }}" method="POST">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label>Tahun <span class="text-danger">*</span></label>
                  <input type="number" name="tahun" class="form-control" value="{{ date('Y') }}" min="2020" max="2030" required>
               </div>
               <div class="form-group">
                  <label>Skor IDM (0-100) <span class="text-danger">*</span></label>
                  <input type="number" name="skor" class="form-control" min="0" max="100" step="0.01" required>
                  <small class="form-text text-muted">Masukkan nilai antara 0-100</small>
               </div>
               <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi atau catatan untuk data IDM..."></textarea>
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
               <button type="submit" class="btn" style="background-color: #0dcdbd; color: white;">Simpan</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Edit IDM Modal -->
<div class="modal fade" id="editIDMModal" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Edit Data IDM</h5>
            <button type="button" class="close" data-dismiss="modal">
               <span>×</span>
            </button>
         </div>
         <form id="editIDMForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
               <div class="form-group">
                  <label>Tahun <span class="text-danger">*</span></label>
                  <input type="number" name="tahun" id="edit_tahun" class="form-control" min="2020" max="2030" required>
               </div>
               <div class="form-group">
                  <label>Skor IDM (0-100) <span class="text-danger">*</span></label>
                  <input type="number" name="skor" id="edit_skor" class="form-control" min="0" max="100" step="0.01" required>
                  <small class="form-text text-muted">Masukkan nilai antara 0-100</small>
               </div>
               <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea name="deskripsi" id="edit_deskripsi" class="form-control" rows="3"></textarea>
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
               <button type="submit" class="btn" style="background-color: #0dcdbd; color: white;">Update</button>
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
      },
      "order": [[1, "desc"]] // Sort by tahun descending
   });

   // Chart.js untuk grafik IDM
   @if(count($chartYears) > 0)
   const ctx = document.getElementById('idmChart').getContext('2d');
   const idmChart = new Chart(ctx, {
      type: 'line',
      data: {
         labels: {!! json_encode(array_reverse($chartYears)) !!},
         datasets: [{
            label: 'Skor IDM',
            data: {!! json_encode(array_reverse($chartScores)) !!},
            borderColor: '#0dcdbd',
            backgroundColor: 'rgba(13, 205, 189, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointRadius: 5,
            pointHoverRadius: 7,
            pointBackgroundColor: '#0dcdbd',
            pointBorderColor: '#fff',
            pointBorderWidth: 2
         }]
      },
      options: {
         responsive: true,
         maintainAspectRatio: true,
         plugins: {
            legend: {
               display: true,
               position: 'top'
            },
            tooltip: {
               callbacks: {
                  label: function(context) {
                     return 'Skor: ' + context.parsed.y;
                  }
               }
            }
         },
         scales: {
            y: {
               beginAtZero: true,
               max: 100,
               ticks: {
                  callback: function(value) {
                     return value;
                  },
                  stepSize: 10
               },
               grid: {
                  display: true,
                  drawBorder: true
               }
            },
            x: {
               grid: {
                  display: false
               }
            }
         }
      }
   });
   @endif
});

function editIDM(id) {
   // Fetch data IDM untuk diedit
   fetch(`/administrator/dashboard/idm/${id}/edit`)
      .then(response => response.json())
      .then(data => {
         document.getElementById('edit_tahun').value = data.tahun;
         document.getElementById('edit_skor').value = data.skor;
         document.getElementById('edit_deskripsi').value = data.deskripsi || '';
         document.getElementById('edit_status').checked = data.status;
         
         document.getElementById('editIDMForm').action = `/administrator/dashboard/idm/${id}`;
         $('#editIDMModal').modal('show');
      })
      .catch(error => {
         console.error('Error:', error);
         alert('Gagal memuat data IDM');
      });
}

function deleteIDM(id) {
   if (confirm('Apakah Anda yakin ingin menghapus data IDM ini?')) {
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = `/administrator/dashboard/idm/${id}`;
      
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
