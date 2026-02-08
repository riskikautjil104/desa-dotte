<?php

namespace App\Http\Controllers;

use App\Models\Belanja;
use App\Models\Berita;
use App\Models\GambaranUmum;
use App\Models\Pembiayaan;
use App\Models\Pembiyayaan;
use App\Models\Pemuda;
use App\Models\Pendapatan;
use App\Models\SambutanLurah;
use App\Models\Sejarah;
use App\Models\StrukturOrganisasi;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    
    public function berita() {
        return view('pages.berita.index',[
            'berita'=> Berita::with([])->latest()->paginate(8)
        ]);
    }
    public function detailberita(Berita $berita) {
        $berita->increment('views');

        return view('pages.berita.detail',[
            'berita'=> $berita,
            'recentberita'=> Berita::paginate(8),
            'sambutan_lurah'=> SambutanLurah::all()
        ]);
    }

    public function visimisi() {
        return view('pages.profil_kelurahan.visi_misi',[
            'visimisi'=> VisiMisi::all()
        ]);
    }

    public function sambutanlurah(SambutanLurah $sambutanLurah) {
        
        DB::table('sambutan_lurah')->increment('views');

        return view('pages.berita.sambutanlurah',[
            'sambutanLurah'=> $sambutanLurah,
            'recentberita'=> Berita::paginate(8),
        ]);
    }

    public function struktur_organisasi() {
            
            return view('pages.profil_kelurahan.struktur_organisasi',[
                'struktur' => StrukturOrganisasi::all(),
            ]);
    }
    public function strukturorganisasiPemuda() {
            
            return view('pages.profil_kelurahan.strukturorganisasiPemuda',[
                'struktur' => Pemuda::all(),
            ]);
    }

    public function sejarah() {
        return view('pages.profil_kelurahan.sejarah',[
            'sejarah'=> Sejarah::all()
        ]);
    }

    public function gambaranumum() {
        return view('pages.profil_kelurahan.gambaran_umum',[
            'gambaranumum'=> GambaranUmum::all()
        ]);
    }

    public function apbdes()
    {
        $currentYear = date('Y');
    
        // Fetch years from pendapatan and belanja
        $pendapatanYear = Pendapatan::select(DB::raw('YEAR(created_at) as year'), DB::raw('SUM(jumlah) as total'))
            ->groupBy('year')
            ->pluck('total', 'year'); // Format: [2022 => total, 2023 => total]
    
        $belanjaYear = DB::table('belanja')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('SUM(jumlah) as total'))
            ->groupBy('year')
            ->pluck('total', 'year'); // Format: [2022 => total, 2023 => total]
    
        // Combine unique years from pendapatan and belanja
        $years = array_unique(array_merge($pendapatanYear->keys()->toArray(), $belanjaYear->keys()->toArray()));
        sort($years); // Sort years in ascending order
    
        // Prepare yearly pendapatan values for chart
        $pendapatanValuesByYear = array_map(function ($year) use ($pendapatanYear) {
            return $pendapatanYear[$year] ?? 0; // Return 0 if no data exists for a year
        }, $years);
    
        // Prepare yearly belanja values for chart
        $belanjaValuesByYear = array_map(function ($year) use ($belanjaYear) {
            return $belanjaYear[$year] ?? 0; // Return 0 if no data exists for a year
        }, $years);
    
        // Fetch data for the current year
        $pendapatan = Pendapatan::select('kategori_pendapatan', DB::raw('SUM(jumlah) as total'))
            ->whereYear('created_at', $currentYear)
            ->groupBy('kategori_pendapatan')
            ->pluck('total', 'kategori_pendapatan'); // Format: [kategori_pendapatan => total]
    
        $belanja = DB::table('belanja')
            ->select('kategori_belanja', DB::raw('SUM(jumlah) as total'))
            ->whereYear('created_at', $currentYear)
            ->groupBy('kategori_belanja')
            ->pluck('total', 'kategori_belanja'); // Format: [kategori_belanja => total]
    
        $pembiayaan = Pembiayaan::whereYear('created_at', $currentYear)
            ->select('kategori_pembiayaan', 'jumlah')
            ->get();
    
        // Calculate totals for the current year
        $totalPendapatan = $pendapatan->sum();
        $totalBelanja = $belanja->sum();
        $surplusDefisit = $totalPendapatan - $totalBelanja;
        $penerimaan = $pembiayaan->where('kategori_pembiayaan', 'Penerimaan')->sum('jumlah');
        $pengeluaran = $pembiayaan->where('kategori_pembiayaan', 'Pengeluaran')->sum('jumlah');
    
        // Pass all required data to the view
        return view('pages.apbdes.index', compact(
            'pendapatan',
            'belanja',
            'pembiayaan',
            'years',
            'pendapatanValuesByYear',
            'belanjaValuesByYear',
            'totalPendapatan',
            'totalBelanja',
            'surplusDefisit',
            'penerimaan',
            'pengeluaran'
        ));
    }
    

public function getDataByYear(Request $request)
{
    // Get the requested year
    $year = $request->query('year', date('Y'));

    // Fetch pendapatan data for the selected year
    $pendapatan = Pendapatan::select('kategori_pendapatan', DB::raw('SUM(jumlah) as total'))
        ->whereYear('created_at', $year)
        ->groupBy('kategori_pendapatan')
        ->get()
        ->map(function($item) {
            return [
                'kategori' => $item->kategori_pendapatan,
                'total' => $item->total
            ];
        });

    // Fetch belanja data for the selected year
    $belanja = DB::table('belanja')
        ->select('kategori_belanja', DB::raw('SUM(jumlah) as total'))
        ->whereYear('created_at', $year)
        ->groupBy('kategori_belanja')
        ->get()
        ->map(function($item) {
            return [
                'kategori' => $item->kategori_belanja,
                'total' => $item->total
            ];
        });

    // Fetch pembiayaan data for the selected year
    $pembiayaan = Pembiayaan::whereYear('created_at', $year)
        ->select('kategori_pembiayaan', 'jumlah')
        ->get();

    // Calculate totals for pendapatan and belanja
    $totalPendapatan = $pendapatan->sum('total');
    $totalBelanja = $belanja->sum('total');

    return response()->json([
        'pendapatan' => [
            'total' => $totalPendapatan,
            'categories' => $pendapatan->pluck('kategori'),
            'values' => $pendapatan->pluck('total')
        ],
        'belanja' => [
            'total' => $totalBelanja,
            'categories' => $belanja->pluck('kategori'),
            'values' => $belanja->pluck('total')
        ],
        'pembiayaan' => [
            'categories' => $pembiayaan->pluck('kategori_pembiayaan'),
            'values' => $pembiayaan->pluck('jumlah'),
            'penerimaan' => $pembiayaan->where('kategori_pembiayaan', 'Penerimaan')->sum('jumlah'),
            'pengeluaran' => $pembiayaan->where('kategori_pembiayaan', 'Pengeluaran')->sum('jumlah')
        ]
    ]);
}

}
