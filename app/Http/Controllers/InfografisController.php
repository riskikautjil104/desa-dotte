<?php

namespace App\Http\Controllers;

use App\Models\Infografis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InfografisController extends Controller
{
    public function index()
    {
        $infografisData = Infografis::orderBy('urutan', 'asc')->paginate(10);
        $totalInfografis = Infografis::count();
        $totalPenduduk = Infografis::where('jenis_infografis', 'penduduk')->count();
        $totalEkonomi = Infografis::where('jenis_infografis', 'ekonomi')->count();
        $totalSosial = Infografis::where('jenis_infografis', 'sosial')->count();

        return view('admin.infografis.index', compact(
            'infografisData',
            'totalInfografis',
            'totalPenduduk',
            'totalEkonomi',
            'totalSosial'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jenis_infografis' => 'required|in:penduduk,ekonomi,sosial,geografis,umum,program',
            'data_json' => 'nullable|array',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'boolean'
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status');
        $data['urutan'] = $data['urutan'] ?? 0;

        // Handle JSON data
        if ($request->filled('data_json')) {
            $data['data_json'] = json_decode($request->data_json, true);
        }

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['gambar_path'] = $file->storeAs('infografis', $filename, 'public');
        }

        Infografis::create($data);

        return redirect()->route('admin.infografis.index')
            ->with('success', 'Data Infografis berhasil ditambahkan!');
    }

    public function update(Request $request, Infografis $infografis)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jenis_infografis' => 'required|in:penduduk,ekonomi,sosial,geografis,umum,program',
            'data_json' => 'nullable|array',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'boolean'
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status');
        $data['urutan'] = $data['urutan'] ?? 0;

        // Handle JSON data
        if ($request->filled('data_json')) {
            $data['data_json'] = json_decode($request->data_json, true);
        }

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($infografis->gambar_path) {
                Storage::disk('public')->delete($infografis->gambar_path);
            }
            
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['gambar_path'] = $file->storeAs('infografis', $filename, 'public');
        }

        $infografis->update($data);

        return redirect()->route('admin.infografis.index')
            ->with('success', 'Data Infografis berhasil diperbarui!');
    }

    public function destroy(Infografis $infografis)
    {
        // Delete image if exists
        if ($infografis->gambar_path) {
            Storage::disk('public')->delete($infografis->gambar_path);
        }

        $infografis->delete();

        return redirect()->route('admin.infografis.index')
            ->with('success', 'Data Infografis berhasil dihapus!');
    }
}
