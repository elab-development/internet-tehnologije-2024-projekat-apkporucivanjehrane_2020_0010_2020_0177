<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restoran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RestoranController extends Controller
{
    /**
     * Prikaz svih restorana sa opcijama za filtriranje i pretragu
     */
    public function index(Request $request)
    {
        $query = Restoran::with(['kategorija', 'jela']);

        // Pretraga po nazivu
        if ($request->has('pretraga')) {
            $query->where('naziv', 'like', '%' . $request->pretraga . '%');
        }

        // Filter po kategoriji
        if ($request->has('kategorija_id')) {
            $query->where('kategorija_id', $request->kategorija_id);
        }

        // Filter po aktivnosti
        if ($request->has('aktivan')) {
            $query->where('aktivan', $request->aktivan);
        }

        // Sortiranje
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Paginacija
        $perPage = $request->get('per_page', 10);
        $restorani = $query->paginate($perPage);

        return response()->json($restorani);
    }

    /**
     * Kreiranje novog restorana
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategorija_id' => 'required|exists:kategorijas,id',
            'naziv' => 'required|string|max:255',
            'opis' => 'nullable|string',
            'adresa' => 'required|string',
            'telefon' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'slika' => 'nullable|string',
            'cena_dostave' => 'nullable|numeric|min:0',
            'vreme_dostave' => 'nullable|integer|min:0',
            'aktivan' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['naziv']) . '-' . uniqid();
        $restoran = Restoran::create($validated);

        return response()->json([
            'message' => 'Restoran uspešno kreiran',
            'data' => $restoran->load('kategorija'),
        ], 201);
    }

    /**
     * Prikaz pojedinačnog restorana
     */
    public function show(Restoran $restoran)
    {
        return response()->json($restoran->load(['kategorija', 'jela']));
    }

    /**
     * Ažuriranje restorana
     */
    public function update(Request $request, Restoran $restoran)
    {
        $validated = $request->validate([
            'kategorija_id' => 'sometimes|exists:kategorijas,id',
            'naziv' => 'sometimes|string|max:255',
            'opis' => 'nullable|string',
            'adresa' => 'sometimes|string',
            'telefon' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'slika' => 'nullable|string',
            'cena_dostave' => 'nullable|numeric|min:0',
            'vreme_dostave' => 'nullable|integer|min:0',
            'ocena' => 'nullable|numeric|between:0,5',
            'aktivan' => 'boolean',
        ]);

        if (isset($validated['naziv']) && $validated['naziv'] !== $restoran->naziv) {
            $validated['slug'] = Str::slug($validated['naziv']) . '-' . uniqid();
        }

        $restoran->update($validated);

        return response()->json([
            'message' => 'Restoran uspešno ažuriran',
            'data' => $restoran->load('kategorija'),
        ]);
    }

    /**
     * Brisanje restorana
     */
    public function destroy(Restoran $restoran)
    {
        $restoran->delete();

        return response()->json([
            'message' => 'Restoran uspešno obrisan',
        ]);
    }
}
