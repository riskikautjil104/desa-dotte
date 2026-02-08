<?php

namespace App\Http\Controllers;

use App\Models\Peta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetaController extends Controller
{
    public function front() {
        return view('pages.peta.peta',[
            'peta' => Peta::all()
        ]);
    }

    public function index() {
        return view('admin.peta.peta',[
            'peta' => Peta::all()
        ]);
    }

    public function store(Request $request) {
        
        $rules = $request->validate([
            'nama_tempat'=>['required'],
            'lat'=>['required'],
            'long'=>['required'],
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->file('gambar')) {
            $rules['gambar'] = $request->file('gambar')->store('Gambarpeta');
        }


        Peta::create($rules);
        return redirect()->route('peta.index')->with('success','Berhasil Di Tambahkan');
    }
    
    public function destroy(Peta $peta)
    {
        if ($peta->gambar) {
            Storage::delete($peta->gambar);
        }

        Peta::destroy($peta->id);
        return redirect()->route('peta.index')->with('success','Berhasil Di Hapus');
    }
}
