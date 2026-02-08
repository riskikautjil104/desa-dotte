<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VisiMisiController extends Controller
{
    public function edit() {
        return view('admin.profilKelurahan.visimisi',[
            "visimisi" => VisiMisi::all()
        ]);
    }

    public function store(Request $request) {

        // dd($request);
        $rules = $request->validate([
            'isi'=>['required'],
        ]);



        VisiMisi::create($rules);
        return redirect()->route('visimisi.index')->with('success','Visi & Misi Berhasil Di Tambahkan');
    }

    public function update(Request $request, VisiMisi $visiMisi)
    {
        // dd([$request]);
        $rules = $request->validate([
            'isi'=>['required'],
        ]);

        $visiMisi->where('id', $visiMisi->id)->update($rules);
        return redirect()->route('visimisi.index')->with('success','Visi & Misi Berhasil Di Ubah');
    }
}
