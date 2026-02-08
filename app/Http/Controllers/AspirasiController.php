<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AspirasiController extends Controller
{
    /**
     * Display a listing of the resource (Frontend).
     */
    public function index(Request $request)
    {
        $query = Aspirasi::latest();

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->status($request->status);
        }

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->kategori($request->kategori);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'like', $searchTerm)
                  ->orWhere('deskripsi', 'like', $searchTerm)
                  ->orWhere('nama', 'like', $searchTerm);
            });
        }

        $aspirasi = $query->paginate(10);

        // Get statistics
        $totalAspirasi = Aspirasi::count();
        $aspirasiBaru = Aspirasi::status('baru')->count();
        $aspirasiDiproses = Aspirasi::status('diproses')->count();
        $aspirasiSelesai = Aspirasi::status('selesai')->count();

        // Get kategori statistics
        $kategoriStats = Aspirasi::selectRaw('kategori, count(*) as count')
            ->groupBy('kategori')
            ->pluck('count', 'kategori');

        // Get top voted aspirasi
        $topAspirasi = Aspirasi::orderBy('votes', 'desc')->take(5)->get();

        return view('pages.aspirasi.index', compact(
            'aspirasi', 
            'totalAspirasi', 
            'aspirasiBaru', 
            'aspirasiDiproses', 
            'aspirasiSelesai',
            'kategoriStats',
            'topAspirasi'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.aspirasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'kategori' => 'required|in:infrastruktur,pendidikan,kesehatan,ekonomi,sosial,lingkungan,lainnya',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->all();

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time() . '_' . Str::slug($request->judul) . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/aspirasi', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        Aspirasi::create($data);

        return redirect()->route('frontend.aspirasi')->with('success', 'Aspirasi berhasil dikirim! Tim kami akan segera meninjaunya.');
    }

    /**
     * Display the specified resource (Frontend).
     */
    public function show(Aspirasi $aspirasi)
    {
        // Increment views
        $aspirasi->incrementViews();

        // Get related aspirasi (same category)
        $relatedAspirasi = Aspirasi::where('id', '!=', $aspirasi->id)
            ->where('kategori', $aspirasi->kategori)
            ->latest()
            ->take(4)
            ->get();

        return view('pages.aspirasi.detail', compact('aspirasi', 'relatedAspirasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aspirasi $aspirasi)
    {
        return view('pages.aspirasi.edit', compact('aspirasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aspirasi $aspirasi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'kategori' => 'required|in:infrastruktur,pendidikan,kesehatan,ekonomi,sosial,lingkungan,lainnya',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->all();

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old foto
            if ($aspirasi->foto) {
                Storage::delete('public/aspirasi/' . $aspirasi->foto);
            }
            
            $foto = $request->file('foto');
            $namaFoto = time() . '_' . Str::slug($request->judul) . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/aspirasi', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $aspirasi->update($data);

        return redirect()->route('frontend.aspirasi')->with('success', 'Aspirasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aspirasi $aspirasi)
    {
        // Delete foto
        if ($aspirasi->foto) {
            Storage::delete('public/aspirasi/' . $aspirasi->foto);
        }
        
        $aspirasi->delete();

        return redirect()->route('admin.aspirasi.index')->with('success', 'Aspirasi berhasil dihapus!');
    }

    /**
     * Vote untuk aspirasi
     */
    public function vote(Aspirasi $aspirasi)
    {
        // Simple voting system (bisa dikembangkan dengan user authentication)
        $aspirasi->addVote();
        
        return response()->json([
            'success' => true,
            'votes' => $aspirasi->fresh()->votes
        ]);
    }

    /**
     * Remove vote untuk aspirasi
     */
    public function unvote(Aspirasi $aspirasi)
    {
        $aspirasi->removeVote();
        
        return response()->json([
            'success' => true,
            'votes' => $aspirasi->fresh()->votes
        ]);
    }

    /**
     * API untuk mendapatkan statistik aspirasi
     */
    public function getStats()
    {
        $stats = [
            'total' => Aspirasi::count(),
            'baru' => Aspirasi::status('baru')->count(),
            'diproses' => Aspirasi::status('diproses')->count(),
            'selesai' => Aspirasi::status('selesai')->count(),
            'ditolak' => Aspirasi::status('ditolak')->count(),
            'kategori' => Aspirasi::selectRaw('kategori, count(*) as count')
                ->groupBy('kategori')
                ->pluck('count', 'kategori')
        ];

        return response()->json($stats);
    }

    /**
     * API untuk filter aspirasi
     */
    public function filter(Request $request)
    {
        $query = Aspirasi::query();

        if ($request->has('status') && $request->status != '') {
            $query->status($request->status);
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->kategori($request->kategori);
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'votes':
                    $query->orderBy('votes', 'desc');
                    break;
                case 'views':
                    $query->orderBy('views', 'desc');
                    break;
                case 'newest':
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $aspirasi = $query->paginate(10);

        return response()->json($aspirasi);
    }

    /**
     * Admin: index untuk dashboard dengan filter & search
     */
    public function adminIndex(Request $request)
    {
        $query = Aspirasi::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $aspirasi = $query->latest()->paginate(15);
        
        return view('admin.aspirasi.index', compact('aspirasi'));
    }

    /**
     * Admin: get aspirasi details (untuk modal)
     */
    public function adminShow(Aspirasi $aspirasi)
    {
        // Load the aspirasi with all needed data
        $aspirasi->load([]); // Add relationships if any
        
        return response()->json([
            'success' => true,
            'aspirasi' => $aspirasi,
            'status_label' => $aspirasi->status_text,
            'kategori_label' => $aspirasi->kategori_label
        ]);
    }

    /**
     * Admin: update status aspirasi
     */
    public function updateStatus(Request $request, Aspirasi $aspirasi)
    {
        $request->validate([
            'status' => 'required|in:baru,diproses,selesai,ditolak',
            'tanggapan' => 'nullable|string'
        ]);

        $data = [
            'status' => $request->status,
        ];

        if ($request->filled('tanggapan')) {
            $data['tanggapan'] = $request->tanggapan;
            $data['tanggal_tanggapan'] = now();
        }

        $aspirasi->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Status aspirasi berhasil diperbarui!'
        ]);
    }
}