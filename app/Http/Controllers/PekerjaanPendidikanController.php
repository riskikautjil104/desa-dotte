<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PekerjaanPendidikanController extends Controller
{
    public function pekerjaan() {
        return view('admin.kependudukan.pekerjaan',[
            'pekerjaan'=> Pekerjaan::all(),
        ]);
    }
    public function pendidikan() {
        return view('admin.kependudukan.pendidikan',[
            'pendidikan'=> Pendidikan::all(),
        ]);
    }

    public function strorePekerjaan(Request $request) {

        $rules = $request->validate([
            'nama_pekerjaan' => 'required',
        ]);
        Pekerjaan::create($rules);
        return redirect()->route('pekerjaan.index')->with('success','Berhasil Di Tambahkan');
    }

    public function destroyPekerjaan(Pekerjaan $pekerjaan)
    {
        try {
            Pekerjaan::destroy($pekerjaan->id);
            return redirect()->route('pekerjaan.index')->with('success','Berhasil Di Hapus');
        }
        catch (\Exception $e) {
            return redirect()->route('pekerjaan.index')->with('error',$pekerjaan->nama_pekerjaan.' Tidak Dapat Di Hapus Mungkin Data Dingunakan Di Tabel Lain');
            // return back()->withError($e->getMessage())->withInput();
        }
    }
    public function strorePendidikan(Request $request) {

        $rules = $request->validate([
            'nama_pendidikan' => 'required',
        ]);
        Pendidikan::create($rules);
        return redirect()->route('pendidikan.index')->with('success','Berhasil Di Tambahkan');
    }

    public function destroyPendidikan(Pendidikan $pendidikan)
    {
        try {
            Pendidikan::destroy($pendidikan->id);
            return redirect()->route('pendidikan.index')->with('success','Berhasil Di Hapus');
        }
        catch (\Exception $e) {
            return redirect()->route('pendidikan.index')->with('error',$pendidikan->nama_pendidikan.' Tidak Dapat Di Hapus Mungkin Data Dingunakan Di Tabel Lain');
            // return back()->withError($e->getMessage())->withInput();
        }

    }
}