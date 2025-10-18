<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProizvodNaMenijuResource;
use App\Models\ProizvodNaMeniju;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProizvodNaMenijuController extends Controller
{
    /**
     * Prikaz svih proizvoda sa paginacijom
     */
    public function index(Request $request): JsonResponse
    {
        $query = ProizvodNaMeniju::with('restoran')->where('is_available', true);

        // Pretraga po nazivu
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filtriranje po restoranu
        if ($request->has('restoran_id')) {
            $query->where('restoran_id', $request->restoran_id);
        }

        // Filtriranje po ceni
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $perPage = $request->get('per_page', 15);
        $proizvodi = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => ProizvodNaMenijuResource::collection($proizvodi),
            'meta' => [
                'current_page' => $proizvodi->currentPage(),
                'last_page' => $proizvodi->lastPage(),
                'per_page' => $proizvodi->perPage(),
                'total' => $proizvodi->total(),
            ]
        ]);
    }

    /**
     * Prikaz jednog proizvoda
     */
    public function show(ProizvodNaMeniju $proizvod): JsonResponse
    {
        $proizvod->load('restoran');

        return response()->json([
            'success' => true,
            'data' => new ProizvodNaMenijuResource($proizvod)
        ]);
    }

    /**
     * Kreiranje novog proizvoda (samo admin)
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'restoran_id' => 'required|exists:restorani,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
            'is_available' => 'boolean',
        ]);

        $proizvod = ProizvodNaMeniju::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Proizvod uspešno kreiran',
            'data' => new ProizvodNaMenijuResource($proizvod)
        ], 201);
    }

    /**
     * Ažuriranje proizvoda (samo admin)
     */
    public function update(Request $request, ProizvodNaMeniju $proizvod): JsonResponse
    {
        $validated = $request->validate([
            'restoran_id' => 'sometimes|exists:restorani,id',
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric|min:0',
            'image' => 'nullable|string',
            'is_available' => 'boolean',
        ]);

        $proizvod->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Proizvod uspešno ažuriran',
            'data' => new ProizvodNaMenijuResource($proizvod)
        ]);
    }

    /**
     * Brisanje proizvoda (samo admin)
     */
    public function destroy(ProizvodNaMeniju $proizvod): JsonResponse
    {
        $proizvod->delete();

        return response()->json([
            'success' => true,
            'message' => 'Proizvod uspešno obrisan'
        ]);
    }
}
