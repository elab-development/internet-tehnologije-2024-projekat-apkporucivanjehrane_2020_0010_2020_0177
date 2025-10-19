<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategorija;
use Illuminate\Http\Request;

class KategorijaController extends Controller
{
    /**
     * Prikaz svih kategorija
     */
    public function index()
    {
        $kategorije = Kategorija::with('restorani')->get();
        return response()->json($kategorije);
    }

    /**
     * Kreiranje nove kategorije
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'naziv' => 'required|string|max:255|unique:kategorijas',
            'opis' => 'nullable|string',
            'slika' => 'nullable|string',
        ]);

        $kategorija = Kategorija::create($validated);

        return response()->json([
            'message' => 'Kategorija uspešno kreirana',
            'data' => $kategorija,
        ], 201);
    }

    /**
     * Prikaz pojedinačne kategorije
     */
    public function show(Kategorija $kategorija)
    {
        return response()->json($kategorija->load('restorani'));
    }

    /**
     * Ažuriranje kategorije
     */
    public function update(Request $request, Kategorija $kategorija)
    {
        $validated = $request->validate([
            'naziv' => 'sometimes|string|max:255|unique:kategorijas,naziv,' . $kategorija->id,
            'opis' => 'nullable|string',
            'slika' => 'nullable|string',
        ]);

        $kategorija->update($validated);

        return response()->json([
            'message' => 'Kategorija uspešno ažurirana',
            'data' => $kategorija,
        ]);
    }

    /**
     * Brisanje kategorije
     */
    public function destroy(Kategorija $kategorija)
    {
        $kategorija->delete();

        return response()->json([
            'message' => 'Kategorija uspešno obrisana',
        ]);
    }
}
