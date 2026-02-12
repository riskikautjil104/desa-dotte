<?php

use App\Http\Controllers\BelanjaController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatapendudukController;
use App\Http\Controllers\PendudukStatusController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\GambaranUmumController;
use App\Http\Controllers\PekerjaanPendidikanController;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SambutanLurahController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\SejarahController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\infoKelurahanController;
use App\Http\Controllers\JenisPelayananController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\PembiayaanController;
use App\Http\Controllers\PemudaController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\IDMController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\UMKMController;
use App\Http\Controllers\DataDesaController;
use App\Http\Controllers\PerkembanganPendudukController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\SuratOnlineController;
use App\Http\Controllers\PPIDController;
use App\Http\Controllers\InfografisController;
use App\Http\Controllers\PendudukSementaraController;
use App\Http\Controllers\GisController;
use App\Http\Controllers\DokumenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BansosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/link', function () {
//     $target = storage_path('app/public');
//     $shortcut = $_SERVER['DOCUMENT_ROOT'] . '/storage';
//     symlink($target, $shortcut);
// });


// ============================================================
// ALTERNATIVE STORAGE LINK ROUTE (Untuk Hosting tanpa SSH)
// ============================================================
// Jika hosting tidak support php artisan storage:link, gunakan route ini
//代替 symlink untuk serve files dari storage/app/public
//============================================================
Route::get('storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);

    if (!file_exists($filePath)) {
        abort(404);
    }

    $mimeTypes = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'pdf' => 'application/pdf',
        'mp4' => 'video/mp4',
        'webm' => 'video/webm',
        'mov' => 'video/quicktime',
    ];

    $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $contentType = $mimeTypes[$ext] ?? 'application/octet-stream';

    return response(file_get_contents($filePath), 200)
        ->header('Content-Type', $contentType)
        ->header('Cache-Control', 'public, max-age=31536000');
})->where('path', '.*');

// ============================================================
// CATATAN: Route symlink DISABLE karena hosting ini tidak support
// Gunakan route /storage/{path} yang sudah di-setup di bawah ini
// ============================================================


// Beranda Routes
Route::get('/', [BerandaController::class, 'index'])->name('home');
Route::get('/login', function () {
    return redirect()->route('login');
});

Route::prefix('/pengguna')->middleware('auth:masyarakat')->group(function () {
    Route::get('/logout', [MasyarakatController::class, 'logout'])->name('mas_logout');
    Route::get('/profil', [MasyarakatController::class, 'profil'])->name('mas_profil');
});

Route::prefix('/pengguna')->middleware('guest:masyarakat,web')->group(function () {
    Route::get('/login', [MasyarakatController::class, 'login'])->name('login');
    Route::get('/register', [MasyarakatController::class, 'register'])->name('mas_register');
    Route::post('/register', [MasyarakatController::class, 'store'])->name('prosesregister');
    Route::post('/login', [MasyarakatController::class, 'proseslogin'])->name('proseslogin');
});

// lurah
Route::prefix('administrator/dashboard')->middleware(['auth:web', 'is_lurah'])->group(function () {
    Route::put('/aprove/{pengaduan}', [DashboardController::class, 'aprove'])->name('aprove');
});

// admin
Route::prefix('administrator/dashboard')->middleware(['auth:web', 'is_admin'])->group(function () {
    Route::get('/data-penduduk/tambah', [DatapendudukController::class, 'create'])->name('datapenduduk.tambah');
    Route::get('/kirim-email/{id}', [PengaduanController::class, 'kirimEmail'])->name('kirimEmail');
    // visimisi
    Route::get('/profil-kelurahan/visi-misi', [VisiMisiController::class, 'edit'])->name('visimisi.index');
    Route::put('/profil-kelurahan/visi-misi/{visiMisi}/update', [VisiMisiController::class, 'update'])->name('visimisi.update');
    Route::post('/profil-kelurahan/visi-misi/', [VisiMisiController::class, 'store'])->name('visimisi.store');
    // sejarah
    Route::get('/profil-kelurahan/sejarah', [SejarahController::class, 'edit'])->name('sejarah.index');
    Route::put('/profil-kelurahan/sejarah/{sejarah}/update', [SejarahController::class, 'update'])->name('sejarah.update');
    Route::post('/profil-kelurahan/sejarah/', [SejarahController::class, 'store'])->name('sejarah.store');
    // gambaran umum
    Route::get('/profil-kelurahan/gambaranumum', [GambaranUmumController::class, 'edit'])->name('gambaranumum.index');
    Route::put('/profil-kelurahan/gambaranumum/{gambaranumum}/update', [GambaranUmumController::class, 'update'])->name('gambaranumum.update');
    Route::post('/profil-kelurahan/gambaranumum/', [GambaranUmumController::class, 'store'])->name('gambaranumum.store');
    //struktur organisani
    Route::get('/profil-kelurahan/struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('organisasi.index');
    Route::post('/profil-kelurahan/tambah-struktur-organisasi/store', [StrukturOrganisasiController::class, 'store'])->name('organisasi.store');
    Route::put('/profil-kelurahan/{struktur_organisasi:id}/edit-struktur-organisasi', [StrukturOrganisasiController::class, 'update'])->name('organisasi.update');
    //struktur organisani
    Route::get('/profil-kelurahan/struktur-organisasi-pemuda', [PemudaController::class, 'index'])->name('strukturorganisasiPemuda.index');
    Route::post('/profil-kelurahan/tambah-struktur-organisasi-pemuda/store', [PemudaController::class, 'store'])->name('strukturorganisasiPemuda.store');
    Route::put('/profil-kelurahan/{struktur_organisasi:id}/edit-struktur-organisasi-pemuda', [PemudaController::class, 'update'])->name('strukturorganisasiPemuda.update');
    // pekerjaan & pendidikan
    Route::get('kependudukan/pekerjaan', [PekerjaanPendidikanController::class, 'pekerjaan'])->name('pekerjaan.index');
    Route::get('kependudukan/pendidikan', [PekerjaanPendidikanController::class, 'pendidikan'])->name('pendidikan.index');
    // pekerjaan
    Route::post('/pekerjaan-pekerjaan', [PekerjaanPendidikanController::class, 'strorePekerjaan'])->name('pekerjaan.store');
    Route::delete('/pekerjaan-pekerjaan/{pekerjaan}', [PekerjaanPendidikanController::class, 'destroyPekerjaan'])->name('pekerjaan.delete');
    // pendidikan
    Route::post('/pendidikan-pendidikan', [PekerjaanPendidikanController::class, 'strorePendidikan'])->name('pendidikan.store');
    Route::delete('/pendidikan-pendidikan/{pendidikan}', [PekerjaanPendidikanController::class, 'destroyPendidikan'])->name('pendidikan.delete');
    // data penduduk
    Route::post('/data-penduduk/tambah/store', [DatapendudukController::class, 'store'])->name('datapenduduk.store');
    Route::get('/data-penduduk/{datapenduduk:nik}/edit', [DatapendudukController::class, 'edit'])->name('datapenduduk.edit');
    Route::put('/data-penduduk/{datapenduduk:id}/edit', [DatapendudukController::class, 'update'])->name('datapenduduk.update');
    Route::delete('/data-penduduk/{datapenduduk}', [DatapendudukController::class, 'destroy'])->name('datapenduduk.delete');
    // Route untuk update status penduduk (kematian/pindah)
    Route::post('/data-penduduk/{datapenduduk:id}/update-status', [PendudukStatusController::class, 'updateStatus'])->name('datapenduduk.update-status');
    // Route untuk melihat data penduduk yang meninggal
    Route::get('/data-penduduk/kematian', [PendudukStatusController::class, 'indexKematian'])->name('datapenduduk.kematian');
    // Route untuk melihat data penduduk yang pindah
    Route::get('/data-penduduk/pindah', [PendudukStatusController::class, 'indexPindah'])->name('datapenduduk.pindah');
    // Route untuk penduduk sementara
    Route::resource('/data-penduduk/sementara', PendudukSementaraController::class)->names([
        'index' => 'penduduk-sementara.index',
        'create' => 'penduduk-sementara.create',
        'store' => 'penduduk-sementara.store',
        'show' => 'penduduk-sementara.show',
        'edit' => 'penduduk-sementara.edit',
        'update' => 'penduduk-sementara.update',
        'destroy' => 'penduduk-sementara.destroy',
    ]);
    // pelayanan
    Route::get('/pelayanan', [PelayananController::class, 'index'])->name('pelayanan.index');
    Route::get('/jenis-pelayanan', [JenisPelayananController::class, 'index'])->name('jenis_pelayanan.index');
    Route::post('/jenis-pelayanan', [JenisPelayananController::class, 'store'])->name('jenis_pelayanan.store');
    Route::delete('/jenis-pelayanan/{jenis_pelayanan}', [JenisPelayananController::class, 'destroy'])->name('jenispelayanan.delete');
    Route::delete('/pelayanan/{pelayanan}', [PelayananController::class, 'destroy'])->name('pelayanan.delete');
    Route::get('/pelayanan/{pelayanan}/detail', [PelayananController::class, 'show'])->name('pelayanan.show');

    Route::prefix('bansos/jenis')->group(function () {
        Route::get('/', [BansosController::class, 'adminJenisBansos'])->name('admin.bansos.jenis.index');
        Route::post('/', [BansosController::class, 'storeJenisBansos'])->name('admin.bansos.jenis.store');
        Route::get('/{jenisBansos}', [BansosController::class, 'showJenisBansos'])->name('admin.bansos.jenis.show');
        Route::put('/{jenisBansos}', [BansosController::class, 'updateJenisBansos'])->name('admin.bansos.jenis.update');
        Route::delete('/{jenisBansos}', [BansosController::class, 'destroyJenisBansos'])->name('admin.bansos.jenis.destroy');
    });

    // PENERIMA BANSOS
    Route::prefix('bansos/penerima')->group(function () {
        Route::get('/', [BansosController::class, 'adminPenerimaBansos'])->name('admin.bansos.penerima.index');
        Route::post('/', [BansosController::class, 'storePenerimaBansos'])->name('admin.bansos.penerima.store');
        Route::get('/{penerimaBansos}', [BansosController::class, 'showPenerimaBansos'])->name('admin.bansos.penerima.show');
        Route::put('/{penerimaBansos}', [BansosController::class, 'updatePenerimaBansos'])->name('admin.bansos.penerima.update');
        Route::delete('/{penerimaBansos}', [BansosController::class, 'destroyPenerimaBansos'])->name('admin.bansos.penerima.destroy');
        Route::post('/{penerimaBansos}/verify', [BansosController::class, 'verifyPenerima'])->name('admin.bansos.penerima.verify');
    });

    // DISTRIBUSI BANSOS
    Route::prefix('bansos/distribusi')->group(function () {
        Route::get('/', [BansosController::class, 'adminDistribusiBansos'])->name('admin.bansos.distribusi.index');
        Route::post('/', [BansosController::class, 'storeDistribusiBansos'])->name('admin.bansos.distribusi.store');
        Route::get('/{distribusiBansos}', [BansosController::class, 'showDistribusiBansos'])->name('admin.bansos.distribusi.show');
        Route::put('/{distribusiBansos}/status', [BansosController::class, 'updateStatusDistribusi'])->name('admin.bansos.distribusi.update-status');
        Route::delete('/{distribusiBansos}', [BansosController::class, 'destroyDistribusiBansos'])->name('admin.bansos.distribusi.destroy');
    });

    // PENGAJUAN BANSOS (Admin)
    Route::prefix('bansos/pengajuan')->group(function () {
        Route::get('/', [BansosController::class, 'adminPengajuanBansos'])->name('admin.bansos.pengajuan.index');
        Route::get('/{pengajuanBansos}', [BansosController::class, 'showPengajuanBansos'])->name('admin.bansos.pengajuan.show');
        Route::post('/{pengajuanBansos}/verify', [BansosController::class, 'verifyPengajuan'])->name('admin.bansos.pengajuan.verify');
        Route::delete('/{pengajuanBansos}', [BansosController::class, 'destroyPengajuanBansos'])->name('admin.bansos.pengajuan.destroy');
    });

    // LAPORAN BANSOS
    Route::get('bansos/laporan', [BansosController::class, 'adminLaporan'])->name('admin.bansos.laporan');
    Route::get('bansos/laporan/export', [BansosController::class, 'exportLaporan'])->name('admin.bansos.laporan.export');

    Route::get('/idm', [IDMController::class, 'index'])->name('admin.idm.index');
    Route::post('/idm', [IDMController::class, 'store'])->name('admin.idm.store');
    Route::get('/idm/{idm}/edit', [IDMController::class, 'edit'])->name('admin.idm.edit'); // TAMBAHKAN INI!
    Route::put('/idm/{idm}', [IDMController::class, 'update'])->name('admin.idm.update');
    Route::delete('/idm/{idm}', [IDMController::class, 'destroy'])->name('admin.idm.destroy');
    Route::get('/ppid', [PPIDController::class, 'index'])->name('admin.ppid.index');
    Route::post('/ppid', [PPIDController::class, 'store'])->name('admin.ppid.store');
    Route::get('/ppid/{ppid}/edit', [PPIDController::class, 'edit'])->name('admin.ppid.edit'); // TAMBAHKAN INI!
    Route::put('/ppid/{ppid}', [PPIDController::class, 'update'])->name('admin.ppid.update');
    Route::delete('/ppid/{ppid}', [PPIDController::class, 'destroy'])->name('admin.ppid.destroy');
});

// dashboard
Route::prefix('administrator/dashboard')->middleware('auth:web')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');
    // kependudukan
    Route::get('/data-penduduk', [DatapendudukController::class, 'index'])->name('datapenduduk.index');
    Route::get('/data-penduduk/export', [DatapendudukController::class, 'export'])->name('datapenduduk.export');
    //berita
    Route::get('/berita/semua-berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/tambah-berita', [BeritaController::class, 'create'])->name('berita.tambah');
    Route::post('/berita/tambah-berita/store', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{berita:slug}/edit-berita', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{berita:slug}/edit-berita', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{berita:slug}', [BeritaController::class, 'destroy'])->name('berita.delete');
    Route::resource('galeris', GaleriController::class);
    Route::resource('videos', VideoController::class);
    Route::resource('gallery', GaleriController::class);
    // sambutan Lurah
    Route::get('/sambutan-kepala-desa', [SambutanLurahController::class, 'edit'])->name('lurah.index');
    Route::post('/sambutan-lurah', [SambutanLurahController::class, 'store'])->name('lurah.store');
    Route::put('/sambutan-lurah/{sambutan}/update', [SambutanLurahController::class, 'update'])->name('lurah.update');
    // pengaduan
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::delete('/pengaduann/{pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.delete');
    Route::get('/pengaduan/{pengaduan}/detail', [PengaduanController::class, 'show'])->name('pengaduan.edit');
    Route::get('/pengaduan/terkirim', [PengaduanController::class, 'terkirim'])->name('pengaduan.terkirim');
    // info Kelurahan
    Route::get('/informasi-kelurahan/rt-rw', [infoKelurahanController::class, 'rt_rw'])->name('rt_rw');
    Route::post('/informasi-kelurahan/rt', [infoKelurahanController::class, 'storeRt'])->name('rt.store');
    Route::put('/informasi-kelurahan/rt/{rt}', [infoKelurahanController::class, 'updateRt'])->name('rt.update');
    Route::delete('/informasi-kelurahan/rt/{rt}', [infoKelurahanController::class, 'destroyRt'])->name('rt.delete');
    Route::post('/informasi-kelurahan/rw', [infoKelurahanController::class, 'storeRw'])->name('rw.store');
    Route::put('/informasi-kelurahan/rw/{rw}', [infoKelurahanController::class, 'updateRw'])->name('rw.update');
    Route::delete('/informasi-kelurahan/rw/{rw}', [infoKelurahanController::class, 'destroyRw'])->name('rw.delete');
    // peta
    Route::get('/peta', [PetaController::class, 'index'])->name('peta.index');
    Route::post('/peta', [PetaController::class, 'store'])->name('peta.store');
    Route::delete('/peta/{peta}', [PetaController::class, 'destroy'])->name('peta.delete');

    // apbdes
    Route::resource('pendapatan', PendapatanController::class);
    Route::resource('belanja', BelanjaController::class);
    // routes/web.php
    Route::resource('pembiayaan', PembiayaanController::class);

    // IDM Routes
    Route::get('/idm', [IDMController::class, 'index'])->name('admin.idm.index');
    Route::post('/idm', [IDMController::class, 'store'])->name('admin.idm.store');
    Route::put('/idm/{idm}', [IDMController::class, 'update'])->name('admin.idm.update');
    Route::delete('/idm/{idm}', [IDMController::class, 'destroy'])->name('admin.idm.destroy');

    // PPID Routes
    Route::get('/ppid', [PPIDController::class, 'index'])->name('admin.ppid.index');
    Route::post('/ppid', [PPIDController::class, 'store'])->name('admin.ppid.store');
    Route::put('/ppid/{ppid}', [PPIDController::class, 'update'])->name('admin.ppid.update');
    Route::delete('/ppid/{ppid}', [PPIDController::class, 'destroy'])->name('admin.ppid.destroy');

    // Infografis Routes
    Route::get('/infografis', [InfografisController::class, 'index'])->name('admin.infografis.index');
    Route::post('/infografis', [InfografisController::class, 'store'])->name('admin.infografis.store');
    Route::put('/infografis/{infografis}', [InfografisController::class, 'update'])->name('admin.infografis.update');
    Route::delete('/infografis/{infografis}', [InfografisController::class, 'destroy'])->name('admin.infografis.destroy');

    // Admin Routes untuk Fitur Baru
    Route::get('agenda', [AgendaController::class, 'adminIndex'])->name('admin.agenda.index');
    Route::get('agenda/create', [AgendaController::class, 'create'])->name('admin.agenda.create');
    Route::post('agenda', [AgendaController::class, 'store'])->name('admin.agenda.store');
    Route::get('agenda/{agenda}', [AgendaController::class, 'adminShow'])->name('admin.agenda.show');
    Route::get('agenda/{agenda}/edit', [AgendaController::class, 'edit'])->name('admin.agenda.edit');
    Route::put('agenda/{agenda}', [AgendaController::class, 'update'])->name('admin.agenda.update');
    Route::delete('agenda/{agenda}', [AgendaController::class, 'destroy'])->name('admin.agenda.destroy');


    Route::resource('umkm', UMKMController::class)->names([
        'index' => 'admin.umkm.index',
        'create' => 'admin.umkm.create',
        'store' => 'admin.umkm.store',
        'show' => 'admin.umkm.show',
        'edit' => 'admin.umkm.edit',
        'update' => 'admin.umkm.update',
        'destroy' => 'admin.umkm.destroy',
    ]);

    // Route::get('aspirasi', [AspirasiController::class, 'adminIndex'])->name('admin.aspirasi.index');
    // Route::get('aspirasi/{aspirasi}', [AspirasiController::class, 'adminShow'])->name('admin.aspirasi.show');
    // Route::post('aspirasi/{aspirasi}/update-status', [AspirasiController::class, 'updateStatus'])->name('admin.aspirasi.update-status');
    // Route::delete('aspirasi/{aspirasi}', [AspirasiController::class, 'destroy'])->name('admin.aspirasi.destroy');
    Route::get('aspirasi', [AspirasiController::class, 'adminIndex'])->name('admin.aspirasi.index');

    // AJAX Routes untuk Modal (IMPORTANT!)
    Route::get('aspirasi/{aspirasi}/detail', [AspirasiController::class, 'adminShow'])->name('admin.aspirasi.detail');
    Route::post('aspirasi/{aspirasi}/update-status', [AspirasiController::class, 'updateStatus'])->name('admin.aspirasi.update-status');

    // Delete Route
    Route::delete('aspirasi/{aspirasi}', [AspirasiController::class, 'destroy'])->name('admin.aspirasi.destroy');


    // Di dalam grup: Route::prefix('administrator/dashboard')->middleware('auth:web')->group(function () {
    Route::get('surat-online', [SuratOnlineController::class, 'adminIndex'])->name('admin.surat-online.index');
    Route::get('surat-online/{suratOnline}', [SuratOnlineController::class, 'adminShow'])->name('admin.surat-online.show');
    Route::put('surat-online/{suratOnline}/status', [SuratOnlineController::class, 'updateStatus'])->name('admin.surat-online.update-status');
    Route::delete('surat-online/{suratOnline}', [SuratOnlineController::class, 'destroy'])->name('admin.surat-online.destroy');
    Route::get('surat-online/{suratOnline}/download', [SuratOnlineController::class, 'downloadFile'])->name('admin.surat-online.download');
});
// end dashboard

Route::prefix('surat-online')->group(function () {
    // Public routes
    Route::get('/', [SuratOnlineController::class, 'index'])->name('frontend.surat-online');
    Route::post('/', [SuratOnlineController::class, 'store'])->name('frontend.surat-online.store');
    Route::get('/{suratOnline}', [SuratOnlineController::class, 'show'])->name('frontend.surat-online.show');
    Route::get('/{suratOnline}/download', [SuratOnlineController::class, 'downloadFile'])->name('frontend.surat-online.download');
});

Route::get('/peta', [PetaController::class, 'front'])->name('peta');

// Profile Routes
Route::prefix('profil')->group(function () {
    Route::get('/visi-misi', [FrontendController::class, 'visimisi'])->name('visimisi');

    Route::get('/gambaran-umum', [FrontendController::class, 'gambaranumum'])->name('gambaran.umum');

    Route::get('/sejarah', [FrontendController::class, 'sejarah'])->name('sejarah');
    Route::get('/struktur-organisasi', [FrontendController::class, 'struktur_organisasi'])->name('struktur.organisasi');
    Route::get('/struktur-organisasi-pemuda', [FrontendController::class, 'strukturorganisasiPemuda'])->name('strukturorganisasiPemuda.organisasi');
});

// Berita Routes
Route::prefix('publikasi')->group(function () {
    Route::get('/berita', [FrontendController::class, 'berita'])->name('berita');
    Route::get('{berita:slug}/detail', [FrontendController::class, 'detailberita'])->name('detail.berita');
    Route::get('/sambutan-lurah/{sambutanLurah:slug}/detail', [FrontendController::class, 'sambutanlurah'])->name('sambutanlurah');

    Route::get('/galeri', [GaleriController::class, 'front'])->name('galeri');
    Route::get('/video', [VideoController::class, 'front'])->name('video');
});

// Frontend Agenda Routes
Route::prefix('agenda')->group(function () {
    Route::get('/', [AgendaController::class, 'index'])->name('frontend.agenda');
    Route::get('{agenda:id}', [AgendaController::class, 'show'])->name('frontend.agenda.detail');
});


// Frontend UMKM Routes
Route::prefix('umkm')->group(function () {
    Route::get('/', [UMKMController::class, 'index'])->name('frontend.umkm');
    Route::get('{umkm:id}', [UMKMController::class, 'show'])->name('frontend.umkm.detail');
    Route::get('/api/search', [UMKMController::class, 'search'])->name('frontend.umkm.search');
    Route::get('/api/kategori', [UMKMController::class, 'getByKategori'])->name('frontend.umkm.kategori');
});

// Frontend Data Desa Interaktif Routes
Route::prefix('data-desa')->group(function () {
    Route::get('/', [DataDesaController::class, 'index'])->name('frontend.data-desa');
    Route::get('/api/penduduk', [DataDesaController::class, 'apiPenduduk'])->name('frontend.data-desa.api-penduduk');
    Route::get('/api/statistik', [DataDesaController::class, 'apiStatistik'])->name('frontend.data-desa.api-statistik');
    Route::get('/api/export', [DataDesaController::class, 'exportData'])->name('frontend.data-desa.export');
});
Route::get('/penduduk-data', function () {
    return view('coming');
})->name('frontend.coming');

// Frontend Perkembangan Penduduk Routes
Route::prefix('perkembangan-penduduk')->group(function () {
    Route::get('/', [PerkembanganPendudukController::class, 'index'])->name('frontend.perkembangan-penduduk');
});

// Frontend Aspirasi Warga Routes
Route::prefix('aspirasi')->group(function () {
    Route::get('/', [AspirasiController::class, 'index'])->name('frontend.aspirasi');
    Route::get('/create', [AspirasiController::class, 'create'])->name('frontend.aspirasi.create');
    Route::post('/', [AspirasiController::class, 'store'])->name('frontend.aspirasi.store');
    Route::get('{aspirasi:id}', [AspirasiController::class, 'show'])->name('frontend.aspirasi.show');
    Route::post('{aspirasi:id}/vote', [AspirasiController::class, 'vote'])->name('frontend.aspirasi.vote');
    Route::delete('{aspirasi:id}/unvote', [AspirasiController::class, 'unvote'])->name('frontend.aspirasi.unvote');
    Route::get('/api/stats', [AspirasiController::class, 'getStats'])->name('frontend.aspirasi.stats');
    Route::get('/api/filter', [AspirasiController::class, 'filter'])->name('frontend.aspirasi.filter');
});

// Statistik Routes
Route::prefix('statistik')->group(function () {

    Route::get('/jenis-kelamin', [StatistikController::class, 'jenis_kelamin'])->name('jenis_kelamin');
    Route::get('/agama', [StatistikController::class, 'agama'])->name('agama');
    Route::get('/pekerjaan', [StatistikController::class, 'pekerjaan'])->name('pekerjaan');
    Route::get('/pendidikan', [StatistikController::class, 'pendidikan'])->name('pendidikan');
    Route::get('/kelompok-umur', [StatistikController::class, 'kelompok_umur'])->name('kelompok_umur');
});
// Statistik Routes
Route::prefix('pelayanan')->group(function () {
    Route::get('/', [PelayananController::class, 'front'])->name('pelayanan');
    Route::post('/', [PelayananController::class, 'store'])->name('pelayanan.store')->middleware('auth:masyarakat');
});


// Pengaduan Routes
Route::get('/pengaduan', [PengaduanController::class, 'frontEnd'])->name('pengaduan');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/reload', [PengaduanController::class, 'reload']);

Route::get('/apbdes', [FrontendController::class, 'apbdes'])->name('apbdes');
Route::get('/apbdes/data', [FrontendController::class, 'getDataByYear']);
// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile-user', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('bansos')->group(function () {
    Route::get('/', [BansosController::class, 'frontendIndex'])->name('frontend.bansos');
    Route::post('/pengajuan', [BansosController::class, 'storePengajuan'])->name('frontend.bansos.pengajuan');
    Route::get('/jenis/{jenisBansos}', [BansosController::class, 'showJenisBansos'])->name('frontend.bansos.jenis');

    // Riwayat pengajuan (untuk user yang login)
    Route::middleware('auth:masyarakat')->group(function () {
        Route::get('/pengajuan-saya', [BansosController::class, 'myPengajuan'])->name('frontend.bansos.my-pengajuan');
    });
});

require __DIR__ . '/auth.php';

// ============================================================
// CHATBOT API Route
// ============================================================
Route::post('/api/chatbot/respond', [App\Http\Controllers\ChatbotController::class, 'respond'])->name('chatbot.respond');

// ============================================================
// GIS Routes - Pemetaan RT/RW
// ============================================================
// Frontend GIS
Route::prefix('gis')->group(function () {
    Route::get('/', [GisController::class, 'index'])->name('gis.index');
    Route::get('/api/all', [GisController::class, 'apiAllData'])->name('gis.api.all');
    Route::get('/api/rt/{id}', [GisController::class, 'apiRtData'])->name('gis.api.rt');
    Route::get('/api/rw/{id}', [GisController::class, 'apiRwData'])->name('gis.api.rw');
    Route::get('/api/penduduk-sementara/{type}/{id}', [GisController::class, 'apiPendudukSementara'])->name('gis.api.sementara');
});

// ============================================================
// Dokumen Routes - Download Center
// ============================================================
// Admin Routes
Route::prefix('administrator/dashboard')->middleware('auth:web')->group(function () {
    Route::resource('dokumen', DokumenController::class)->names([
        'index' => 'admin.dokumen.index',
        'create' => 'admin.dokumen.create',
        'store' => 'admin.dokumen.store',
        'show' => 'admin.dokumen.show',
        'edit' => 'admin.dokumen.edit',
        'update' => 'admin.dokumen.update',
        'destroy' => 'admin.dokumen.destroy',
    ]);
    Route::get('dokumen/{dokumen}/download', [DokumenController::class, 'download'])->name('admin.dokumen.download');
});

// Frontend Routes
Route::prefix('dokumen')->group(function () {
    Route::get('/', [DokumenController::class, 'frontendIndex'])->name('frontend.dokumen.index');
    Route::get('/{dokumen}', [DokumenController::class, 'frontendShow'])->name('frontend.dokumen.show');
    Route::get('/{dokumen}/download', [DokumenController::class, 'download'])->name('frontend.dokumen.download');
});
// Test final
