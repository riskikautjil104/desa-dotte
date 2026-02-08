<?php

namespace App\Http\Controllers;

use App\Models\Datapenduduk;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function jenis_kelamin () {
        return view('pages.statistik_kelurahan.jenis_kelamin',[
            'penduduk' => Datapenduduk::with([])->get(),
        ]);
    }

    public  function agama () {
        return view('pages.statistik_kelurahan.agama',[
            'penduduk' => Datapenduduk::with([])->get(),
        ]);
    }

    public  function pekerjaan () {

        return view('pages.statistik_kelurahan.pekerjaan',[
            'pekerjaan' => Pekerjaan::with("datapenduduk")->get(),
            'penduduk' => Datapenduduk::with(['pekerjaan'])->get(),
        ]);
    }
    public  function pendidikan () {

        return view('pages.statistik_kelurahan.pendidikan',[
            'pendidikan' => Pendidikan::with("datapenduduk")->get(),
            'penduduk' => Datapenduduk::with(['pekerjaan'])->get(),
        ]);
    }
    public  function kelompok_umur () {

        return view('pages.statistik_kelurahan.kelompok_umur',[
            'penduduk' => Datapenduduk::with([])->get(),
            
        ]);
    }

    
}
