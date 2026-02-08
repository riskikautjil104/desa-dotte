<?php

namespace App\Http\Controllers;

use App\Models\Sejarah;
use Illuminate\Http\Request;

class SejarahController extends Controller
{
    public function edit() {
        return view('admin.profilKelurahan.sejarah',[
            "sejarah" => Sejarah::all()
        ]);
    }

    public function store(Request $request) {

        // dd($request);
        $rules = $request->validate([
            'isi'=>['required'],
        ]);



        Sejarah::create($rules);
        return redirect()->route('sejarah.index')->with('success','Sejarah Kelurahan Berhasil Di Tambahkan');
    }

    public function update(Request $request, Sejarah $sejarah)
    {
        // dd([$request]);
        $rules = $request->validate([
            'isi'=>['required'],
        ]);

        $sejarah->where('id', $sejarah->id)->update($rules);
        return redirect()->route('sejarah.index')->with('success','Sejarah Kelurahan Berhasil Di Ubah');
    }
}
