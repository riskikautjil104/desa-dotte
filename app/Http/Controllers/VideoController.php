<?php
// app/Http/Controllers/VideoController.php
namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->get();
        return view('admin.publikasi.video', compact('videos'));
    }

    public function create()
    {
        return view('video.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            // 'video_path' => 'required|file|mimes:mp4',
            'video_path' => 'required|file|mimes:mp4|max:102400',
        ]);

        $path = $request->file('video_path')->store('videos', 'public');

        Video::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'video_path' => $path,
        ]);

        return redirect()->route('videos.index')->with('success', 'Video created successfully.');
    }

    // Metode untuk menghapus video
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        
        // Menghapus file video dari storage
        if (Storage::disk('public')->exists($video->video_path)) {
            Storage::disk('public')->delete($video->video_path);
        }

        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Video berhasil dihapus.');
    }

    public function front()
    {
        $videos = Video::latest()->get(); // Ambil semua data video
        return view('pages.publikasi.video', compact('videos'));
    }
}