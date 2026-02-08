<?php

namespace App\Http\Controllers;

use App\Mail\kirimPengaduan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;



class PengaduanController extends Controller
{

  
    function index() {
        return view('admin.pengaduan.index',[
            'pengaduan'=> Pengaduan::where('terkirim',0)->get(),
        ]);
    }

    function terkirim() {
        return view('admin.pengaduan.terkirim',[
            'pengaduan'=> Pengaduan::where('terkirim',1)->get(),
        ]);
    }

    function frontEnd() {
            return view('pages.pengaduan.index');
    }

    public function store(Request $request) {

        $rules = $request->validate([
            'nama'=> 'required',
            'nik'=> 'required|numeric|digits:16',
            'email'=> 'required|email:rfc,dns',
            'jenis_pengaduan'=> 'required',
            'deskripsi'=> 'required',
            'lampiran'=> 'required|mimes:doc,docx,pdf,jpeg,png,jpg|max:2048',
        ]);
    
        if ($request->file('lampiran')) {
            $rules['lampiran'] = $request->file('lampiran')->store('lampiranPengaduan');
        }
  
        Pengaduan::create($rules);
        return redirect()->route('pengaduan')->with('success','Berhasil Di Kirim');
    }

    public function kirimEmail($id) {

        $data = Pengaduan::find($id);
       
        Mail::to($data->email)->send(new kirimPengaduan($data) );

        $data->where('id', $data->id)->update(["terkirim" => 1]);

        return redirect()->route('pengaduan.index')->with('success','Berhasil Di Kirim');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if ($pengaduan->lampiran) {
            Storage::delete($pengaduan->lampiran);
        }
        
        Pengaduan::destroy($pengaduan->id);
        return redirect()->route('pengaduan.index')->with('success','Berhasil Di Hapus');
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show',[
            'pengaduan'=>$pengaduan
        ]);
    }
}
