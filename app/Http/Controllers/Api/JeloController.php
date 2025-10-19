<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jelo;
use Illuminate\Http\Request;

class JeloController extends Controller
{
    /**
     * Prikaz svih jela
     */
    public function index(Request $request)
    {
        $query = Jelo::with('restoran');

        // Filter po restoranu
        if ($request->has('restoran_id')) {
            $query->where('restoran_id', $request->restoran_id);
        }

        // Filter po dostupnosti
        if ($request->has('dostupno')) {
            $query->where('dostupno', $request->dostupno);
        }

        // Pretraga po nazivu
        if ($request->has('pretraga')) {
            $query->where('naziv', 'like', '%' . $request->pretraga . '%');
        }

        // Paginacija
        $perPage = $request->get('per_page', 15);
        $jela = $query->paginate($perPage);

        return response()->json($jela);
    }

    /**
     * Kreiranje novog jela
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'restoran_id' => 'required|exists:restorans,id',
            'naziv' => 'required|string|max:255',
            'opis' => 'nullable|string',
            'cena' => 'required|numeric|min:0',
            'slika' => 'nullable|string',
            'dostupno' => 'boolean',
            'kategorija_jela' => 'nullable|string',
        ]);

        $jelo = Jelo::create($validated);

        return response()->json([
            'message' => 'Jelo uspešno kreirano',
            'data' => $jelo->load('restoran'),
        ], 201);
    }

    /**
     * Prikaz pojedinačnog jela
     */
    public function show(Jelo $jelo)
    {
        return response()->json($jelo->load('restoran'));
    }

    /**
     * Ažuriranje jela
     */
    public function update(Request $request, Jelo $jelo)
    {
        $validated = $request->validate([
            'naziv' => 'sometimes|string|max:255',
            'opis' => 'nullable|string',
            'cena' => 'sometimes|numeric|min:0',
            'slika' => 'nullable|string',
            'dostupno' => 'boolean',
            'kategorija_jela' => 'nullable|string',
        ]);

        $jelo->update($validated);

        return response()->json([
            'message' => 'Jelo uspešno ažurirano',
            'data' => $jelo->load('restoran'),
        ]);
    }

    /**
     * Brisanje jela
     */
    public function destroy(Jelo $jelo)
    {
        $jelo->delete();

        return response()->json([
            'message' => 'Jelo uspešno obrisano',
        ]);
    }
}
