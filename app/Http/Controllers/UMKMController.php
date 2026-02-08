<?php

namespace App\Http\Controllers;

use App\Models\UMKM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UMKMController extends Controller
{
    /**
     * Display a listing of the resource for ADMIN.
     */
    public function index(Request $request)
    {
        // Check if this is admin request (has auth:web middleware)
        if ($request->is('administrator/*')) {
            return $this->adminIndex($request);
        }
        
        // Frontend index
        return $this->frontendIndex($request);
    }

    /**
     * Frontend index untuk halaman publik
     */
    protected function frontendIndex(Request $request)
    {
        $query = UMKM::aktif()->latest();

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_usaha', 'like', $searchTerm)
                  ->orWhere('pemilik', 'like', $searchTerm)
                  ->orWhere('deskripsi', 'like', $searchTerm);
            });
        }

        $umkm = $query->paginate(12);

        // Get featured UMKM untuk sidebar
        $featuredUMKM = UMKM::where('is_featured', true)
            ->where('status', 'aktif')
            ->latest()
            ->take(3)
            ->get();

        // Get kategori counts
        $kategoriCounts = UMKM::where('status', 'aktif')
            ->selectRaw('kategori, count(*) as count')
            ->groupBy('kategori')
            ->pluck('count', 'kategori');

        return view('pages.umkm.index', compact('umkm', 'featuredUMKM', 'kategoriCounts'));
    }

    /**
     * Admin index untuk dashboard admin
     */
    protected function adminIndex(Request $request)
    {
        $query = UMKM::latest();

        // Search
        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_usaha', 'like', $searchTerm)
                  ->orWhere('pemilik', 'like', $searchTerm)
                  ->orWhere('deskripsi', 'like', $searchTerm);
            });
        }

        // Filter kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $umkm = $query->paginate(15);

        return view('admin.umkm.index', compact('umkm'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $umkm = UMKM::findOrFail($id);
        
        // Check if this is admin request
        if (request()->is('administrator/*')) {
            return view('admin.umkm.show', compact('umkm'));
        }

        // Frontend show - increment views
        $umkm->increment('views');

        // Get UMKM related
        $relatedUMKM = UMKM::where('status', 'aktif')
            ->where('id', '!=', $umkm->id)
            ->where('kategori', $umkm->kategori)
            ->latest()
            ->take(4)
            ->get();

        // Jika tidak ada yang related, ambil random
        if ($relatedUMKM->isEmpty()) {
            $relatedUMKM = UMKM::where('status', 'aktif')
                ->where('id', '!=', $umkm->id)
                ->latest()
                ->take(4)
                ->get();
        }

        return view('pages.umkm.detail', compact('umkm', 'relatedUMKM'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.umkm.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'kategori' => 'required|in:makanan,minuman,fashion,jasa,kerajinan,teknologi,lainnya',
            'deskripsi' => 'required|string',
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:aktif,nonaktif,verifikasi'
        ]);

        $data = $request->except('galeri', 'gambar_utama');
        
        // Set is_featured to false if not checked
        $data['is_featured'] = $request->has('is_featured') ? true : false;

        // Handle gambar utama upload
        if ($request->hasFile('gambar_utama')) {
            $gambar = $request->file('gambar_utama');
            $namaGambar = time() . '_' . Str::slug($request->nama_usaha) . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('umkm', $namaGambar, 'public');
            $data['gambar_utama'] = $namaGambar;
        }

        // Handle galeri upload
        if ($request->hasFile('galeri')) {
            $galeriFiles = [];
            foreach ($request->file('galeri') as $file) {
                $namaFile = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('umkm/galeri', $namaFile, 'public');
                $galeriFiles[] = $namaFile;
            }
            $data['galeri'] = json_encode($galeriFiles); // Store as JSON
        }

        UMKM::create($data);

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $umkm = UMKM::findOrFail($id);
        return view('admin.umkm.edit', compact('umkm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $umkm = UMKM::findOrFail($id);
        
        $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'kategori' => 'required|in:makanan,minuman,fashion,jasa,kerajinan,teknologi,lainnya',
            'deskripsi' => 'required|string',
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:aktif,nonaktif,verifikasi'
        ]);

        $data = $request->except('galeri', 'gambar_utama');
        
        // Set is_featured
        $data['is_featured'] = $request->has('is_featured') ? true : false;

        // Handle gambar utama upload
        if ($request->hasFile('gambar_utama')) {
            // Delete old gambar
            if ($umkm->gambar_utama) {
                Storage::disk('public')->delete('umkm/' . $umkm->gambar_utama);
            }
            
            $gambar = $request->file('gambar_utama');
            $namaGambar = time() . '_' . Str::slug($request->nama_usaha) . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('umkm', $namaGambar, 'public');
            $data['gambar_utama'] = $namaGambar;
        }

        // Handle galeri upload
        if ($request->hasFile('galeri')) {
            // Delete old galeri
            if ($umkm->galeri) {
                $oldGaleri = is_string($umkm->galeri) ? json_decode($umkm->galeri, true) : $umkm->galeri;
                if (is_array($oldGaleri)) {
                    foreach ($oldGaleri as $file) {
                        Storage::disk('public')->delete('umkm/galeri/' . $file);
                    }
                }
            }
            
            $galeriFiles = [];
            foreach ($request->file('galeri') as $file) {
                $namaFile = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('umkm/galeri', $namaFile, 'public');
                $galeriFiles[] = $namaFile;
            }
            $data['galeri'] = json_encode($galeriFiles); // Store as JSON
        }

        $umkm->update($data);

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $umkm = UMKM::findOrFail($id);
        
        // Delete gambar utama
        if ($umkm->gambar_utama) {
            Storage::disk('public')->delete('umkm/' . $umkm->gambar_utama);
        }
        
        // Delete galeri
        if ($umkm->galeri) {
            $galeriFiles = is_string($umkm->galeri) ? json_decode($umkm->galeri, true) : $umkm->galeri;
            if (is_array($galeriFiles)) {
                foreach ($galeriFiles as $file) {
                    Storage::disk('public')->delete('umkm/galeri/' . $file);
                }
            }
        }
        
        $umkm->delete();

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil dihapus!');
    }

    /**
     * API untuk mendapatkan UMKM berdasarkan kategori
     */
    public function getByKategori(Request $request)
    {
        $kategori = $request->query('kategori');
        $umkm = UMKM::where('status', 'aktif')
            ->where('kategori', $kategori)
            ->latest()
            ->paginate(12);

        return response()->json([
            'data' => $umkm->items(),
            'pagination' => [
                'current_page' => $umkm->currentPage(),
                'last_page' => $umkm->lastPage(),
                'per_page' => $umkm->perPage(),
                'total' => $umkm->total()
            ]
        ]);
    }

    /**
     * API untuk search UMKM
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        $kategori = $request->get('kategori');

        $umkmQuery = UMKM::where('status', 'aktif');

        if ($kategori) {
            $umkmQuery->where('kategori', $kategori);
        }

        if ($query) {
            $searchTerm = '%' . $query . '%';
            $umkmQuery->where(function($q) use ($searchTerm) {
                $q->where('nama_usaha', 'like', $searchTerm)
                  ->orWhere('pemilik', 'like', $searchTerm)
                  ->orWhere('deskripsi', 'like', $searchTerm);
            });
        }

        $umkm = $umkmQuery->latest()->paginate(12);

        return response()->json([
            'data' => $umkm->items(),
            'pagination' => [
                'current_page' => $umkm->currentPage(),
                'last_page' => $umkm->lastPage(),
                'per_page' => $umkm->perPage(),
                'total' => $umkm->total()
            ]
        ]);
    }
}