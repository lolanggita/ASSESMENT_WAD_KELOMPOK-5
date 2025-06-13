<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;

/**
 * @var \Illuminate\Contracts\Auth\StatefulGuard|\Illuminate\Contracts\Auth\Factory $auth
 */
class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ukm');
    }

    // Menampilkan semua foto galeri milik UKM
    public function index()
    {
        // Pastikan user adalah UKM dan memiliki galeri
        $galleries = Auth::user()->galleries;

        return view('gallery.index', compact('galleries'));
    }

    // Menampilkan form upload
    public function create()
    {
        return view('gallery.create');
    }

    // Menyimpan foto baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image')->store('galleries', 'public');

        Auth::user()->galleries()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $path,
        ]);

        return redirect()->route('gallery.index')->with('success', 'Foto berhasil diupload.');
    }

    // Menampilkan detail foto
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Pastikan hanya pemilik yang bisa melihat
        if ($gallery->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('gallery.show', compact('gallery'));
    }

    // Menghapus foto
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Foto berhasil dihapus.');
    }
}