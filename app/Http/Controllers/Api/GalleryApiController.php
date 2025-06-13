<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryApiController extends Controller
{
    public function index()
    {
        $galleries = Auth::user()->galleries;
        return response()->json($galleries);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image')->store('galleries', 'public');

        $gallery = Auth::user()->galleries()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $path,
        ]);

        return response()->json(['message' => 'Foto berhasil diupload.', 'data' => $gallery], 201);
    }

    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->ukm_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        return response()->json($gallery);
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->ukm_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();

        return response()->json(['message' => 'Foto berhasil dihapus.']);
    }
}
