<?php

namespace App\Http\Controllers;

use App\Exports\DatapendudukExport;
use App\Models\Berita;
use App\Models\Datapenduduk;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\Rt;
use App\Models\Rw;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DatapendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 8919916
        return view('admin.kependudukan.index',[
            'data_penduduk'=> Datapenduduk::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kependudukan.tambah',[
            'rt'=>Rt::all(),
            'rw'=>Rw::all(),
            'pekerjaan'=>Pekerjaan::all(),
            'pendidikan'=>Pendidikan::all(),
        ]);   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $rules = $request->validate([
            'id_rt' => 'required',
            'id_rw' => 'required',
            'id_pekerjaan' => 'required',
            'id_pendidikan' => 'required',
            'nik'=>['required','unique:datapenduduks'],
            'nama' => 'required',
            'alamat' => 'required',
            'no_kk' => 'required',
            'nama_kepala_keluarga' => 'required',
            'jenis_kelamin' => 'required',
            'hubungan' => 'required',
            'status' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'usia' => 'required',
            'golongan_darah' => 'required',
            'kewarganegaraan' => 'required',
            'suku' => 'required',
            'agama' => 'required',
        ]);
        Datapenduduk::create($rules);
        return redirect()->route('datapenduduk.index')->with('success','Data Penduduk Berhasil Di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Datapenduduk $datapenduduk)
    {
        return view('admin.kependudukan.edit',[
            'penduduk'=>$datapenduduk,
            'rt'=>Rt::all(),
            'rw'=>Rw::all(),
            'pekerjaan'=>Pekerjaan::all(),
            'pendidikan'=>Pendidikan::all(),
        ]);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Datapenduduk $datapenduduk)
    {
        $rules = [
            'id_rt' => 'required',
            'id_rw' => 'required',
            'id_pekerjaan' => 'required',
            'id_pendidikan' => 'required',
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_kk' => 'required',
            'nama_kepala_keluarga' => 'required',
            'jenis_kelamin' => 'required',
            'hubungan' => 'required',
            'status' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'usia' => 'required',
            'golongan_darah' => 'required',
            'kewarganegaraan' => 'required',
            'suku' => 'required',
            'agama' => 'required',
            'dusun' => 'required',
        ];

        if ($request->nik != $datapenduduk->nik) {
            $rules['nik'] = 'required|unique:datapenduduks';
        }

        $validate = $request->validate($rules);

        $datapenduduk->update($validate);
        return redirect()->route('datapenduduk.index')->with('success','Data Penduduk '.$datapenduduk->nama.' Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Datapenduduk $datapenduduk)
    {
        Datapenduduk::destroy($datapenduduk->id);
        return redirect()->route('datapenduduk.index')->with('success','Data Penduduk Berhasil Di Hapus');
    }

    public function export()
    {
        return (new DatapendudukExport)->download('datapenduduk-'.Carbon::now()->timestamp.'.xlsx');
    }


}
