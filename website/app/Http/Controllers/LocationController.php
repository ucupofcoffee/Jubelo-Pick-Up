<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        return view('location.index', [
            'title' => 'Location',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $location = new Location();
        $location->latitude = $validatedData['latitude'];
        $location->longitude = $validatedData['longitude'];
        $location->save();

        return response()->json(['message' => 'Location saved successfully!'], 201);
    }
}
