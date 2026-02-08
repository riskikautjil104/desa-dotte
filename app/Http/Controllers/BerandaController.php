<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Datapenduduk;
use App\Models\SambutanLurah;
use App\Models\PendudukSementara;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index() {

        
        if (request('cari-berita')) {
            $berita = Berita::where('judul','like','%' . request('cari-berita') .'%')
                                ->orWhere('isi','like','%' . request('cari-berita') .'%')->get();
        }else{
            $berita = Berita::paginate(6);
        }

        // dd($berita);
            return view('pages.index',[
                'berita'=> $berita,
                'recent_post'=> Berita::with([])->latest()->paginate(5),
                'hero'=> Berita::with([])->latest()->paginate(2),
                'sambutan_lurah'=> SambutanLurah::with([])->where('id', 1)->get(),
                'jumlah_penduduk' => Datapenduduk::all()->count(),
                'jumlah_perempuan' =>Datapenduduk::where('jenis_kelamin', "PEREMPUAN")->count(),
                'jumlah_laki_laki' =>Datapenduduk::where('jenis_kelamin', "LAKI-LAKI")->count(),
                'jumlah_kk' => Datapenduduk::distinct('no_kk')->count('no_kk'),
                'jumlah_penduduk_sementara' => PendudukSementara::where('status', true)->count(),
                'total_penduduk_all' => Datapenduduk::all()->count() + PendudukSementara::where('status', true)->count()
            ]);
    }

    
}
