<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UkmProfileApiController extends Controller
{
        /**
     * Display a listing of the UKM profiles.
     */
    public function index()
    {
        $ukmProfiles = UkmProfile::all();
        return response()->json([
            'success' => true,
            'data' => $ukmProfiles,
        ]);
    }

    /**
     * Display the specified UKM profile.
     */
    public function show(UkmProfile $ukmProfile)
    {
        return response()->json([
            'success' => true,
            'data' => $ukmProfile,
        ]);
    }
}
