<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\Rw;
use App\Models\Datapenduduk;
use App\Models\PendudukSementara;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GisController extends Controller
{
    /**
     * Display the GIS map page.
     */
    public function index()
    {
        $rts = Rt::with('datapenduduk')->get();
        $rws = Rw::with('datapenduduk')->get();
        
        return view('pages.gis.index', compact('rts', 'rws'));
    }

    /**
     * API untuk mengambil data statistik RT.
     */
    public function apiRtData($id)
    {
        try {
            $rt = Rt::with('datapenduduk')->findOrFail($id);
            
            $penduduk = $rt->datapenduduk;
            
            // Data gender - handle case insensitive dan variasi format
            $laki_laki = $penduduk->filter(function($p) {
                $jk = strtoupper(trim($p->jenis_kelamin ?? ''));
                return $jk === 'LAKI-LAKI' || $jk === 'L' || $jk === 'LKI' || $jk === 'MALE' || $jk === 'M';
            })->count();
            
            $perempuan = $penduduk->filter(function($p) {
                $jk = strtoupper(trim($p->jenis_kelamin ?? ''));
                return $jk === 'PEREMPUAN' || $jk === 'P' || $jk === 'PR' || $jk === 'FEMALE' || $jk === 'F';
            })->count();
            
            // Data kelompok usia
            $usia_0_14 = $penduduk->filter(function($p) {
                return isset($p->usia) && $p->usia >= 0 && $p->usia <= 14;
            })->count();
            
            $usia_15_59 = $penduduk->filter(function($p) {
                return isset($p->usia) && $p->usia >= 15 && $p->usia <= 59;
            })->count();
            
            $usia_60_plus = $penduduk->filter(function($p) {
                return isset($p->usia) && $p->usia >= 60;
            })->count();
            
            // Data KK (kepala keluarga)
            $jumlah_kk = $penduduk->where('hubungan', 'Kepala Keluarga')->count();
            
            // Data pendidikan
            $pendidikan = $penduduk->groupBy('id_pendidikan')->map(function($items) {
                return [
                    'nama' => $items->first()->pendidikan ? $items->first()->pendidikan->nama_pendidikan : 'Tidak Diketahui',
                    'jumlah' => $items->count()
                ];
            })->sortByDesc('jumlah')->values();
            
            // Data pekerjaan
            $pekerjaan = $penduduk->groupBy('id_pekerjaan')->map(function($items) {
                return [
                    'nama' => $items->first()->pekerjaan ? $items->first()->pekerjaan->nama_pekerjaan : 'Tidak Diketahui',
                    'jumlah' => $items->count()
                ];
            })->sortByDesc('jumlah')->values();
            
            // Data agama
            $agama = $penduduk->groupBy('agama')->map(function($items) {
                return [
                    'nama' => $items->first()->agama ?? 'Tidak Diketahui',
                    'jumlah' => $items->count()
                ];
            })->sortByDesc('jumlah')->values();
            
            return response()->json([
                'success' => true,
                'data' => [
                    'nama_rt' => $rt->nama_rt,
                    'total_penduduk' => $penduduk->count(),
                    'laki_laki' => $laki_laki,
                    'perempuan' => $perempuan,
                    'jumlah_kk' => $jumlah_kk,
                    'kelompok_usia' => [
                        '0_14_tahun' => $usia_0_14,
                        '15_59_tahun' => $usia_15_59,
                        '60_plus_tahun' => $usia_60_plus
                    ],
                    'pendidikan' => $pendidikan,
                    'pekerjaan' => $pekerjaan,
                    'agama' => $agama,
                    'latitude' => $rt->latitude,
                    'longitude' => $rt->longitude
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error in apiRtData: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * API untuk mengambil data statistik RW.
     */
    public function apiRwData($id)
    {
        try {
            $rw = Rw::with('datapenduduk')->findOrFail($id);
            
            $penduduk = $rw->datapenduduk;
            
            // Data gender - handle case insensitive dan variasi format
            $laki_laki = $penduduk->filter(function($p) {
                $jk = strtoupper(trim($p->jenis_kelamin ?? ''));
                return $jk === 'LAKI-LAKI' || $jk === 'L' || $jk === 'LKI' || $jk === 'MALE' || $jk === 'M';
            })->count();
            
            $perempuan = $penduduk->filter(function($p) {
                $jk = strtoupper(trim($p->jenis_kelamin ?? ''));
                return $jk === 'PEREMPUAN' || $jk === 'P' || $jk === 'PR' || $jk === 'FEMALE' || $jk === 'F';
            })->count();
            
            // Data kelompok usia
            $usia_0_14 = $penduduk->filter(function($p) {
                return isset($p->usia) && $p->usia >= 0 && $p->usia <= 14;
            })->count();
            
            $usia_15_59 = $penduduk->filter(function($p) {
                return isset($p->usia) && $p->usia >= 15 && $p->usia <= 59;
            })->count();
            
            $usia_60_plus = $penduduk->filter(function($p) {
                return isset($p->usia) && $p->usia >= 60;
            })->count();
            
            // Data KK (kepala keluarga)
            $jumlah_kk = $penduduk->where('hubungan', 'Kepala Keluarga')->count();
            
            // Data pendidikan
            $pendidikan = $penduduk->groupBy('id_pendidikan')->map(function($items) {
                return [
                    'nama' => $items->first()->pendidikan ? $items->first()->pendidikan->nama_pendidikan : 'Tidak Diketahui',
                    'jumlah' => $items->count()
                ];
            })->sortByDesc('jumlah')->values();
            
            // Data pekerjaan
            $pekerjaan = $penduduk->groupBy('id_pekerjaan')->map(function($items) {
                return [
                    'nama' => $items->first()->pekerjaan ? $items->first()->pekerjaan->nama_pekerjaan : 'Tidak Diketahui',
                    'jumlah' => $items->count()
                ];
            })->sortByDesc('jumlah')->values();
            
            // Data agama
            $agama = $penduduk->groupBy('agama')->map(function($items) {
                return [
                    'nama' => $items->first()->agama ?? 'Tidak Diketahui',
                    'jumlah' => $items->count()
                ];
            })->sortByDesc('jumlah')->values();
            
            // Data RT dalam RW
            $rts = $rw->datapenduduk->groupBy('id_rt')->map(function($items, $key) {
                $rt = Rt::find($key);
                return [
                    'id' => $key,
                    'nama_rt' => $rt ? $rt->nama_rt : 'RT ' . $key,
                    'jumlah_penduduk' => $items->count()
                ];
            })->values();
            
            return response()->json([
                'success' => true,
                'data' => [
                    'nama_rw' => $rw->nama_rw,
                    'total_penduduk' => $penduduk->count(),
                    'laki_laki' => $laki_laki,
                    'perempuan' => $perempuan,
                    'jumlah_kk' => $jumlah_kk,
                    'kelompok_usia' => [
                        '0_14_tahun' => $usia_0_14,
                        '15_59_tahun' => $usia_15_59,
                        '60_plus_tahun' => $usia_60_plus
                    ],
                    'pendidikan' => $pendidikan,
                    'pekerjaan' => $pekerjaan,
                    'agama' => $agama,
                    'rts' => $rts,
                    'latitude' => $rw->latitude,
                    'longitude' => $rw->longitude
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error in apiRwData: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * API untuk mengambil semua data RT/RW untuk peta.
     */
    public function apiAllData()
    {
        try {
            // Get RTs with valid coordinates only
            $rts = Rt::with('datapenduduk')
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->get()
                ->map(function($rt) {
                    $penduduk = $rt->datapenduduk;
                    $laki_laki = $penduduk->filter(function($p) {
                        $jk = strtoupper(trim($p->jenis_kelamin ?? ''));
                        return $jk === 'LAKI-LAKI' || $jk === 'L' || $jk === 'LKI' || $jk === 'MALE' || $jk === 'M';
                    })->count();
                    
                    $perempuan = $penduduk->filter(function($p) {
                        $jk = strtoupper(trim($p->jenis_kelamin ?? ''));
                        return $jk === 'PEREMPUAN' || $jk === 'P' || $jk === 'PR' || $jk === 'FEMALE' || $jk === 'F';
                    })->count();
                    
                    return [
                        'id' => $rt->id,
                        'type' => 'rt',
                        'nama' => 'RT ' . $rt->nama_rt,
                        'latitude' => (float) $rt->latitude,
                        'longitude' => (float) $rt->longitude,
                        'total_penduduk' => $penduduk->count(),
                        'laki_laki' => $laki_laki,
                        'perempuan' => $perempuan,
                    ];
                });
            
            // Get RWs with valid coordinates only
            $rws = Rw::with('datapenduduk')
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->get()
                ->map(function($rw) {
                    $penduduk = $rw->datapenduduk;
                    $laki_laki = $penduduk->filter(function($p) {
                        $jk = strtoupper(trim($p->jenis_kelamin ?? ''));
                        return $jk === 'LAKI-LAKI' || $jk === 'L' || $jk === 'LKI' || $jk === 'MALE' || $jk === 'M';
                    })->count();
                    
                    $perempuan = $penduduk->filter(function($p) {
                        $jk = strtoupper(trim($p->jenis_kelamin ?? ''));
                        return $jk === 'PEREMPUAN' || $jk === 'P' || $jk === 'PR' || $jk === 'FEMALE' || $jk === 'F';
                    })->count();
                    
                    return [
                        'id' => $rw->id,
                        'type' => 'rw',
                        'nama' => 'RW ' . $rw->nama_rw,
                        'latitude' => (float) $rw->latitude,
                        'longitude' => (float) $rw->longitude,
                        'total_penduduk' => $penduduk->count(),
                        'laki_laki' => $laki_laki,
                        'perempuan' => $perempuan,
                    ];
                });
            
            Log::info('GIS Data loaded', [
                'rts_count' => $rts->count(),
                'rws_count' => $rws->count()
            ]);
            
            return response()->json([
                'success' => true,
                'rts' => $rts,
                'rws' => $rws
            ]);
        } catch (\Exception $e) {
            Log::error('Error in apiAllData: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * API untuk mengambil data penduduk sementara per RT/RW.
     */
    public function apiPendudukSementara($type, $id)
    {
        try {
            if ($type === 'rt') {
                $model = Rt::findOrFail($id);
            } else {
                $model = Rw::findOrFail($id);
            }
            
            $sementara = PendudukSementara::where('id_rt', $id)
                ->orWhere('id_rw', $id)
                ->count();
            
            return response()->json([
                'success' => true,
                'data' => [
                    'nama' => $model->nama_rt ?? $model->nama_rw,
                    'jumlah_penduduk_sementara' => $sementara
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error in apiPendudukSementara: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}