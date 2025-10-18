<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestoranResource;
use App\Models\Restoran;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RestoranController extends Controller
{
    /**
     * Prikaz svih restorana sa paginacijom i filtrovanjem
     */
    public function index(Request $request): JsonResponse
    {
        $query = Restoran::with('category')->where('is_active', true);

        // Pretraga po nazivu
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filtriranje po kategoriji
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filtriranje po ceni dostave
        if ($request->has('max_delivery_price')) {
            $query->where('delivery_price', '<=', $request->max_delivery_price);
        }

        // Sortiranje
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Paginacija
        $perPage = $request->get('per_page', 15);
        $restorani = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => RestoranResource::collection($restorani),
            'meta' => [
                'current_page' => $restorani->currentPage(),
                'last_page' => $restorani->lastPage(),
                'per_page' => $restorani->perPage(),
                'total' => $restorani->total(),
            ]
        ]);
    }

    /**
     * Prikaz jednog restorana
     */
    public function show(Restoran $restoran): JsonResponse
    {
        $restoran->load('category', 'proizvodiNaMeniju');

        return response()->json([
            'success' => true,
            'data' => new RestoranResource($restoran)
        ]);
    }

    /**
     * Kreiranje novog restorana (samo admin)
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:restorani,slug',
            'description' => 'nullable|string',
            'address' => 'required|string',
            'phone' => 'nullable|string',
            'image' => 'nullable|string',
            'delivery_price' => 'required|numeric|min:0',
            'delivery_time' => 'required|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $restoran = Restoran::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Restoran uspešno kreiran',
            'data' => new RestoranResource($restoran)
        ], 201);
    }

    /**
     * Ažuriranje restorana (samo admin)
     */
    public function update(Request $request, Restoran $restoran): JsonResponse
    {
        $validated = $request->validate([
            'category_id' => 'sometimes|exists:categories,id',
            'name' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|max:255|unique:restorani,slug,' . $restoran->id,
            'description' => 'nullable|string',
            'address' => 'sometimes|string',
            'phone' => 'nullable|string',
            'image' => 'nullable|string',
            'delivery_price' => 'sometimes|numeric|min:0',
            'delivery_time' => 'sometimes|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $restoran->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Restoran uspešno ažuriran',
            'data' => new RestoranResource($restoran)
        ]);
    }

    /**
     * Brisanje restorana (samo admin)
     */
    public function destroy(Restoran $restoran): JsonResponse
    {
        $restoran->delete();

        return response()->json([
            'success' => true,
            'message' => 'Restoran uspešno obrisan'
        ]);
    }

    /**
     * Prikaz menija restorana (svi proizvodi)
     */
    public function menu(Restoran $restoran): JsonResponse
    {
        $proizvodi = $restoran->proizvodiNaMeniju()
            ->where('is_available', true)
            ->get();

        return response()->json([
            'success' => true,
            'restoran' => new RestoranResource($restoran),
            'proizvodi' => $proizvodi
        ]);
    }
}
