<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource (Frontend).
     */
    public function index()
    {
        $agenda = Agenda::published()->latest()->paginate(10);
        return view('pages.agenda.index', compact('agenda'));
    }

    /**
     * Display the specified resource (Frontend).
     */
    public function show(Agenda $agenda)
    {
        $agenda->increment('views');
        
        $recentAgenda = Agenda::published()
            ->where('id', '!=', $agenda->id)
            ->latest()
            ->take(5)
            ->get();
            
        return view('pages.agenda.detail', compact('agenda', 'recentAgenda'));
    }

    /**
     * Agenda untuk dashboard admin dengan filter & search.
     */
    public function adminIndex(Request $request)
    {
        $query = Agenda::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('pembicara', 'like', "%{$search}%");
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

        $agenda = $query->latest()->paginate(15);
        
        return view('admin.agenda.index', compact('agenda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jam_mulai' => 'nullable|date_format:H:i',
            'jam_selesai' => 'nullable|date_format:H:i|after:jam_mulai',
            'lokasi' => 'nullable|string|max:255',
            'pembicara' => 'nullable|string|max:255',
            'kategori' => 'required|in:umum,rapat,seleksi,acara_budaya,seminar',
            'status' => 'required|in:akan_datang,sedang_berlangsung,selesai',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_published' => 'boolean'
        ]);

        $data = $request->all();
        
        // Set is_published default to false if not checked
        $data['is_published'] = $request->has('is_published') ? true : false;

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . Str::slug($request->judul) . '.' . $gambar->getClientOriginalExtension();
            // Simpan langsung ke 'agenda' tanpa prefix 'public/'
            $gambar->storeAs('agenda', $namaGambar, 'public');
            $data['gambar'] = $namaGambar;
        }

        Agenda::create($data);

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil ditambahkan!');
    }

    /**
     * Display the specified resource (Admin).
     */
    public function adminShow(Agenda $agenda)
    {
        return view('admin.agenda.show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jam_mulai' => 'nullable|date_format:H:i',
            'jam_selesai' => 'nullable|date_format:H:i|after:jam_mulai',
            'lokasi' => 'nullable|string|max:255',
            'pembicara' => 'nullable|string|max:255',
            'kategori' => 'required|in:umum,rapat,seleksi,acara_budaya,seminar',
            'status' => 'required|in:akan_datang,sedang_berlangsung,selesai',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_published' => 'boolean'
        ]);

        $data = $request->all();
        
        // Set is_published
        $data['is_published'] = $request->has('is_published') ? true : false;

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            // Delete old gambar
            if ($agenda->gambar) {
                Storage::disk('public')->delete('agenda/' . $agenda->gambar);
            }
            
            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . Str::slug($request->judul) . '.' . $gambar->getClientOriginalExtension();
            // Simpan langsung ke 'agenda' tanpa prefix 'public/'
            $gambar->storeAs('agenda', $namaGambar, 'public');
            $data['gambar'] = $namaGambar;
        }

        $agenda->update($data);

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        // Delete gambar
        if ($agenda->gambar) {
            Storage::disk('public')->delete('agenda/' . $agenda->gambar);
        }
        
        $agenda->delete();

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil dihapus!');
    }

    /**
     * API untuk mendapatkan agenda berdasarkan tahun (untuk kalender)
     */
    public function getAgendaByYear(Request $request)
    {
        $year = $request->query('year', date('Y'));
        
        $agenda = Agenda::published()
            ->whereYear('tanggal_mulai', $year)
            ->select('id', 'judul', 'tanggal_mulai', 'tanggal_selesai', 'kategori', 'status')
            ->get();

        return response()->json($agenda);
    }
}