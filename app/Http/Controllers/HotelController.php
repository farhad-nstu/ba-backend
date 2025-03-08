<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $hotels = Hotel::paginate(8); // Pagination
        return response()->json($hotels);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'cost_per_night' => 'required|numeric',
            'available_rooms' => 'required|integer',
            'image_url' => 'nullable|url',
        ]);

        $hotel = Hotel::create($request->all());

        return response()->json($hotel, 201);
    }

    public function show($id)
    {
        $hotel = Hotel::findOrFail($id);
        return response()->json($hotel);
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->update($request->all());
        return response()->json($hotel);
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
        return response()->json(['message' => 'Hotel deleted successfully']);
    }
}

