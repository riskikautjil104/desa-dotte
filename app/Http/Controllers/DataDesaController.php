<?php

namespace App\Http\Controllers;

use App\Models\Datapenduduk;
use App\Models\PendudukKematian;
use App\Models\PendudukPindah;
use App\Models\Berita;
use App\Models\Agenda;
use App\Models\UMKM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataDesaController extends Controller
{
    /**
     * Display dashboard data desa interaktif
     */
    public function index()
    {
        // Get basic statistics
        $totalPenduduk = Datapenduduk::count();
        $totalPerempuan = Datapenduduk::where('jenis_kelamin', 'PEREMPUAN')->count();
        $totalLakiLaki = Datapenduduk::where('jenis_kelamin', 'LAKI-LAKI')->count();
        $totalKK = Datapenduduk::distinct('no_kk')->count('no_kk');
        $totalUMKM = UMKM::aktif()->count();
$totalAgenda = Agenda::where('tanggal_mulai', '>=', Carbon::now()->toDateString())->count();
        $totalBerita = Berita::count();

        // Get agama statistics
        $agamaStats = Datapenduduk::select('agama', DB::raw('count(*) as count'))
            ->groupBy('agama')
            ->pluck('count', 'agama');

// Get pekerjaan statistics (top 10)
        $pekerjaanStats = Datapenduduk::with('pekerjaan')
            ->get()
            ->groupBy('pekerjaan.nama_pekerjaan')
            ->map(function($items) {
                return $items->count();
            })
            ->sortDesc()
            ->take(10);

        // Get pendidikan statistics
        $pendidikanStats = Datapenduduk::with('pendidikan')
            ->get()
            ->groupBy('pendidikan.nama_pendidikan')
            ->map(function($items) {
                return $items->count();
            })
            ->sortDesc();

        // Get kelompok umur statistics
        $kelompokUmur = [
            '0-5' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 5')->count(),
            '6-11' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 6 AND 11')->count(),
            '12-17' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 12 AND 17')->count(),
            '18-25' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 18 AND 25')->count(),
            '26-35' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 26 AND 35')->count(),
            '36-45' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 36 AND 45')->count(),
            '46-55' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 46 AND 55')->count(),
            '56-65' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 56 AND 65')->count(),
            '65+' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 65')->count(),
        ];

        // Get recent data for timeline
        $recentAgenda = Agenda::where('tanggal_mulai', '>=', Carbon::now()->subDays(30)->toDateString())
            ->orderBy('tanggal_mulai')
            ->take(5)
            ->get();

        $recentUMKM = UMKM::aktif()
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Get UMKM kategori statistics
        $umkmKategori = UMKM::aktif()
            ->selectRaw('kategori, count(*) as count')
            ->groupBy('kategori')
            ->pluck('count', 'kategori');

        // Get gender trend (monthly)
        $monthlyTrend = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyTrend[] = [
                'month' => $month->format('M Y'),
                'laki' => Datapenduduk::where('jenis_kelamin', 'LAKI-LAKI')
                    ->whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count(),
                'perempuan' => Datapenduduk::where('jenis_kelamin', 'PEREMPUAN')
                    ->whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count(),
            ];
        }

        // Get perkembangan penduduk (bulan ini vs bulan lalu)
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth()->month;
        $lastYear = Carbon::now()->subMonth()->year;

        // Bulan ini
        $kelahiranBulanIni = Datapenduduk::whereMonth('tanggal_lahir', $currentMonth)
            ->whereYear('tanggal_lahir', $currentYear)
            ->count();
        $masukBulanIni = Datapenduduk::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
        // Kematian: hitung dari tabel penduduk_kematian
        $meninggalBulanIni = PendudukKematian::whereMonth('tanggal_kematian', $currentMonth)
            ->whereYear('tanggal_kematian', $currentYear)
            ->count();
        // Pindah: hitung dari tabel penduduk_pindah
        $keluarBulanIni = PendudukPindah::whereMonth('tanggal_pindah', $currentMonth)
            ->whereYear('tanggal_pindah', $currentYear)
            ->count();

        // Bulan lalu
        $kelahiranBulanLalu = Datapenduduk::whereMonth('tanggal_lahir', $lastMonth)
            ->whereYear('tanggal_lahir', $lastYear)
            ->count();
        $masukBulanLalu = Datapenduduk::whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $lastYear)
            ->count();
        $meninggalBulanLalu = PendudukKematian::whereMonth('tanggal_kematian', $lastMonth)
            ->whereYear('tanggal_kematian', $lastYear)
            ->count();
        $keluarBulanLalu = PendudukPindah::whereMonth('tanggal_pindah', $lastMonth)
            ->whereYear('tanggal_pindah', $lastYear)
            ->count();

        // Perkembangan penduduk bulanan (6 bulan terakhir)
        $perkembanganPenduduk = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $perkembanganPenduduk[] = [
                'month' => $month->format('M Y'),
                'kelahiran' => Datapenduduk::whereMonth('tanggal_lahir', $month->month)
                    ->whereYear('tanggal_lahir', $month->year)
                    ->count(),
                'masuk' => Datapenduduk::whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)
                    ->count(),
                'keluar' => PendudukPindah::whereMonth('tanggal_pindah', $month->month)
                    ->whereYear('tanggal_pindah', $month->year)
                    ->count(),
                'meninggal' => PendudukKematian::whereMonth('tanggal_kematian', $month->month)
                    ->whereYear('tanggal_kematian', $month->year)
                    ->count(),
            ];
        }

        return view('pages.data-desa.index', compact(
            'totalPenduduk',
            'totalPerempuan',
            'totalLakiLaki',
            'totalKK',
            'totalUMKM',
            'totalAgenda',
            'totalBerita',
            'agamaStats',
            'pekerjaanStats',
            'pendidikanStats',
            'kelompokUmur',
            'recentAgenda',
            'recentUMKM',
            'umkmKategori',
            'monthlyTrend',
            // Perkembangan Penduduk
            'kelahiranBulanIni',
            'masukBulanIni',
            'keluarBulanIni',
            'meninggalBulanIni',
            'kelahiranBulanLalu',
            'masukBulanLalu',
            'keluarBulanLalu',
            'meninggalBulanLalu',
            'perkembanganPenduduk'
        ));
    }

    /**
     * API endpoint untuk data penduduk
     */
    public function apiPenduduk(Request $request)
    {
        $query = Datapenduduk::query();

        // Apply filters
        if ($request->has('agama') && $request->agama != '') {
            $query->where('agama', $request->agama);
        }

        if ($request->has('jenis_kelamin') && $request->jenis_kelamin != '') {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'like', $searchTerm)
                  ->orWhere('nik', 'like', $searchTerm)
                  ->orWhere('alamat', 'like', $searchTerm);
            });
        }

        if ($request->has('limit')) {
            $data = $query->limit($request->limit)->get();
        } else {
            $data = $query->paginate(50);
        }

        return response()->json([
            'data' => $data,
            'total' => Datapenduduk::count()
        ]);
    }

    /**
     * API endpoint untuk statistik
     */
    public function apiStatistik(Request $request)
    {
        $type = $request->get('type', 'agama');

        switch ($type) {
            case 'agama':
                $data = Datapenduduk::select('agama', DB::raw('count(*) as count'))
                    ->groupBy('agama')
                    ->get();
                break;

            case 'pekerjaan':
                $data = Datapenduduk::select('pekerjaan', DB::raw('count(*) as count'))
                    ->groupBy('pekerjaan')
                    ->orderBy('count', 'desc')
                    ->limit(20)
                    ->get();
                break;

            case 'pendidikan':
                $data = Datapenduduk::select('pendidikan', DB::raw('count(*) as count'))
                    ->groupBy('pendidikan')
                    ->orderBy('count', 'desc')
                    ->get();
                break;

            case 'kelompok_umur':
                $data = [
                    ['label' => '0-5', 'count' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 5')->count()],
                    ['label' => '6-11', 'count' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 6 AND 11')->count()],
                    ['label' => '12-17', 'count' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 12 AND 17')->count()],
                    ['label' => '18-25', 'count' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 18 AND 25')->count()],
                    ['label' => '26-35', 'count' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 26 AND 35')->count()],
                    ['label' => '36-45', 'count' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 36 AND 45')->count()],
                    ['label' => '46-55', 'count' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 46 AND 55')->count()],
                    ['label' => '56-65', 'count' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 56 AND 65')->count()],
                    ['label' => '65+', 'count' => Datapenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 65')->count()],
                ];
                break;

            default:
                return response()->json(['error' => 'Invalid type'], 400);
        }

        return response()->json($data);
    }

    /**
     * Export data desa
     */
    public function exportData(Request $request)
    {
        $type = $request->get('type', 'penduduk');
        $format = $request->get('format', 'json');

        switch ($type) {
            case 'penduduk':
                $data = Datapenduduk::all();
                $filename = 'data-penduduk-' . date('Y-m-d');
                break;

            case 'statistik':
                $data = [
                    'agama' => Datapenduduk::select('agama', DB::raw('count(*) as count'))->groupBy('agama')->get(),
                    'pekerjaan' => Datapenduduk::select('pekerjaan', DB::raw('count(*) as count'))->groupBy('pekerjaan')->get(),
                    'pendidikan' => Datapenduduk::select('pendidikan', DB::raw('count(*) as count'))->groupBy('pendidikan')->get(),
                    'umkm' => UMKM::aktif()->select('kategori', DB::raw('count(*) as count'))->groupBy('kategori')->get(),
                ];
                $filename = 'statistik-desa-' . date('Y-m-d');
                break;

            default:
                return response()->json(['error' => 'Invalid export type'], 400);
        }

        if ($format === 'json') {
            return response()->json([
                'filename' => $filename,
                'data' => $data,
                'exported_at' => Carbon::now()->toISOString()
            ]);
        }

        return response()->json(['error' => 'Unsupported format'], 400);
    }

    /**
     * Get summary statistics for dashboard
     */
    public function getSummary()
    {
        $summary = [
            'total_penduduk' => Datapenduduk::count(),
            'penduduk_laki' => Datapenduduk::where('jenis_kelamin', 'LAKI-LAKI')->count(),
            'penduduk_perempuan' => Datapenduduk::where('jenis_kelamin', 'PEREMPUAN')->count(),
            'total_kk' => Datapenduduk::distinct('no_kk')->count('no_kk'),
            'total_umkm' => UMKM::aktif()->count(),
            'total_agenda' => Agenda::count(),
            'total_berita' => Berita::count(),
            'last_updated' => Carbon::now()->toISOString(),
        ];

        return response()->json($summary);
    }
}
