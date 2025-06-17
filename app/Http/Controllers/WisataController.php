<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    // GET /wisatas
    public function index()
    {
        $wisatas = Wisata::all();

        return response()->json($wisatas);
    }

    // GET /wisatas/{id}
    public function show($id)
    {
        $wisata = Wisata::find($id);
        if (!$wisata) {
            return response()->json(['message' => 'Wisata not found'], 404);
        }

        return response()->json($wisata);
    }

    // POST /wisatas
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('wisatas', 'public');
            // $validated['image'] = $imagePath;
            $validated['path'] = $imagePath;
        }

        $wisata = Wisata::create($validated);

        return response()->json(['message' => 'Wisata created successfully', 'wisata' => $wisata], 201);
    }

    // PUT /wisatas/{id}
    public function update(Request $request, $id)
    {
        $wisata = Wisata::find($id);
        if (!$wisata) {
            return response()->json(['message' => 'Wisata not found'], 404);
        }

        $validated = $request->validate([                                                                                                                                                                                                                                                             
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'location' => 'sometimes|required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($wisata->path && Storage::disk('public')->exists($wisata->path)) {
                Storage::disk('public')->delete($wisata->path);
            }

            $imagePath = $request->file('image')->store('wisatas', 'public');
            // $validated['image'] = $imagePath;
            $validated['path'] = $imagePath;
        }

        $wisata->update($validated);

        return response()->json(['message' => 'Wisata updated successfully', 'wisata' => $wisata]);
    }

    // DELETE /wisatas/{id}
    public function destroy($id)
    {
        $wisata = Wisata::find($id);
        if (!$wisata) {
            return response()->json(['message' => 'Wisata not found'], 404);
        }

        // Hapus gambar jika ada
        if ($wisata->path && Storage::disk('public')->exists($wisata->path)) {
            Storage::disk('public')->delete($wisata->path);
        }

        $wisata->delete();

        return response()->json(['message' => 'Wisata deleted successfully']);
    }
}
