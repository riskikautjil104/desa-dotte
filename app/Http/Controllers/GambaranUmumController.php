<?php

namespace App\Http\Controllers;

use App\Models\GambaranUmum;
use Illuminate\Http\Request;

class GambaranUmumController extends Controller
{
    public function edit() {
        return view('admin.profilKelurahan.gambaranumum',[
            "gambaranumum" => GambaranUmum::all()
        ]);
    }

    public function store(Request $request) {

        // dd($request);
        $rules = $request->validate([
            'isi'=>['required'],
        ]);



        GambaranUmum::create($rules);
        return redirect()->route('gambaranumum.index')->with('success','Gambaran Umum Kelurahan Berhasil Di Tambahkan');
    }

    public function update(Request $request, GambaranUmum $gambaranumum)
    {
        // dd([$request]);
        $rules = $request->validate([
            'isi'=>['required'],
        ]);

        $gambaranumum->where('id', $gambaranumum->id)->update($rules);
        return redirect()->route('gambaranumum.index')->with('success','Gambaran Umum Kelurahan Berhasil Di Ubah');
    }
}
