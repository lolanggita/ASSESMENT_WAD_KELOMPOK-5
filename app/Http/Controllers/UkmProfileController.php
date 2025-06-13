<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UkmProfileController extends Controller
{
     /**
     * Display a listing of the UKM profiles.
     */
    public function index()
    {
        $ukmProfiles = UkmProfile::all();
        return view('ukm_profiles.index', compact('ukmProfiles'));
    }

    /**
     * Show the form for creating a new UKM profile.
     */
    public function create()
    {
        return view('ukm_profiles.create');
    }

    /**
     * Store a newly created UKM profile in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'logo' => 'nullable|image|max:2048',
            'kontak' => 'required|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $path;
        }

        UkmProfile::create($validated);

        return redirect()->route('ukm_profiles.index')->with('success', 'Profil UKM berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified UKM profile.
     */
    public function edit(UkmProfile $ukmProfile)
    {
        return view('ukm_profiles.edit', compact('ukmProfile'));
    }

    /**
     * Update the specified UKM profile in storage.
     */
    public function update(Request $request, UkmProfile $ukmProfile)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'logo' => 'nullable|image|max:2048',
            'kontak' => 'required|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($ukmProfile->logo) {
                Storage::disk('public')->delete($ukmProfile->logo);
            }
            $path = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $path;
        }

        $ukmProfile->update($validated);

        return redirect()->route('ukm_profiles.index')->with('success', 'Profil UKM berhasil diperbarui.');
    }

    /**
     * Remove the specified UKM profile from storage.
     */
    public function destroy(UkmProfile $ukmProfile)
    {
        if ($ukmProfile->logo) {
            Storage::disk('public')->delete($ukmProfile->logo);
        }
        $ukmProfile->delete();

        return redirect()->route('ukm_profiles.index')->with('success', 'Profil UKM berhasil dihapus.');
    }
}
