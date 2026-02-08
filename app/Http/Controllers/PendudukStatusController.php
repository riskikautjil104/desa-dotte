<?php

namespace App\Http\Controllers;

use App\Models\Datapenduduk;
use App\Models\PendudukKematian;
use App\Models\PendudukPindah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PendudukStatusController extends Controller
{
    /**
     * Handle status change untuk kematian atau pindah
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:MENINGGAL,PINDAH',
            'tanggal_kejadian' => 'required|date',
            'alasan' => 'nullable|string|max:255',
            'tempat_kejadian' => 'nullable|string|max:200',
            'jenis_pindah' => 'nullable|in:Dalam Kota,Luar Kota,Luar Provinsi,Luar Negeri',
        ]);

        DB::beginTransaction();
        try {
            $penduduk = Datapenduduk::findOrFail($id);

            if ($request->status === 'MENINGGAL') {
                // Pindahkan ke tabel kematian
                PendudukKematian::create([
                    'nik' => $penduduk->nik,
                    'nama' => $penduduk->nama,
                    'tanggal_kematian' => $request->tanggal_kejadian,
                    'sebab_kematian' => $request->alasan,
                    'tempat_kematian' => $request->tempat_kejadian,
                    'yang_melaporkan' => null,
                    'hub_dengan_almarhum' => null,
                ]);

                // Hapus dari tabel datapenduduk
                $penduduk->delete();

                Log::info("Penduduk {$penduduk->nama} (NIK: {$penduduk->nik}) dipindahkan ke tabel kematian");
            } elseif ($request->status === 'PINDAH') {
                // Pindahkan ke tabel pindah
                PendudukPindah::create([
                    'nik' => $penduduk->nik,
                    'nama' => $penduduk->nama,
                    'tanggal_pindah' => $request->tanggal_kejadian,
                    'alamat_asal' => $penduduk->alamat,
                    'tujuan_pindah' => $request->tempat_kejadian,
                    'alasan_pindah' => $request->alasan,
                    'jenis_pindah' => $request->jenis_pindah ?? 'Dalam Kota',
                ]);

                // Hapus dari tabel datapenduduk
                $penduduk->delete();

                Log::info("Penduduk {$penduduk->nama} (NIK: {$penduduk->nik}) dipindahkan ke tabel pindah");
            }

            DB::commit();

            return redirect()->route('datapenduduk.index')
                ->with('success', "Data penduduk berhasil dipindahkan ke tabel " . strtolower($request->status));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error moving penduduk: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memproses data.');
        }
    }

    /**
     * Get statistik kematian
     */
    public function statistikKematian($bulan = null, $tahun = null)
    {
        $bulan = $bulan ?? date('m');
        $tahun = $tahun ?? date('Y');

        return PendudukKematian::whereMonth('tanggal_kematian', $bulan)
            ->whereYear('tanggal_kematian', $tahun)
            ->count();
    }

    /**
     * Get statistik pindah
     */
    public function statistikPindah($bulan = null, $tahun = null)
    {
        $bulan = $bulan ?? date('m');
        $tahun = $tahun ?? date('Y');

        return PendudukPindah::whereMonth('tanggal_pindah', $bulan)
            ->whereYear('tanggal_pindah', $tahun)
            ->count();
    }

    /**
     * Get trend kematian 6 bulan terakhir
     */
    public function trendKematian()
    {
        $trends = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $trends[] = [
                'month' => $month->format('M Y'),
                'count' => PendudukKematian::whereMonth('tanggal_kematian', $month->month)
                    ->whereYear('tanggal_kematian', $month->year)
                    ->count(),
            ];
        }
        return $trends;
    }

    /**
     * Get trend pindah 6 bulan terakhir
     */
    public function trendPindah()
    {
        $trends = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $trends[] = [
                'month' => $month->format('M Y'),
                'count' => PendudukPindah::whereMonth('tanggal_pindah', $month->month)
                    ->whereYear('tanggal_pindah', $month->year)
                    ->count(),
            ];
        }
        return $trends;
    }

    /**
     * Index untuk data penduduk yang meninggal
     */
    public function indexKematian()
    {
        $pendudukKematian = PendudukKematian::orderBy('tanggal_kematian', 'desc')->paginate(10);

        return view('admin.kependudukan.kematian', compact('pendudukKematian'));
    }

    /**
     * Index untuk data penduduk yang pindah
     */
    public function indexPindah()
    {
        $pendudukPindah = PendudukPindah::orderBy('tanggal_pindah', 'desc')->paginate(10);

        return view('admin.kependudukan.pindah', compact('pendudukPindah'));
    }
}

