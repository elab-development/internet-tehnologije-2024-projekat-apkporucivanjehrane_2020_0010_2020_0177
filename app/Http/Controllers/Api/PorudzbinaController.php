<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PorudzbinaResource;
use App\Models\Porudzbina;
use App\Models\ProizvodNaMeniju;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PorudzbinaController extends Controller
{
    /**
     * Prikaz svih porudžbina korisnika
     */
    public function index(): JsonResponse
    {
        $porudzbine = Porudzbina::with(['restoran', 'proizvodi'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => PorudzbinaResource::collection($porudzbine)
        ]);
    }

    /**
     * Kreiranje nove porudžbine
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'restoran_id' => 'required|exists:restorani,id',
            'delivery_address' => 'required|string',
            'note' => 'nullable|string',
            'proizvodi' => 'required|array|min:1',
            'proizvodi.*.id' => 'required|exists:proizvod_na_menijus,id',
            'proizvodi.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        
        try {
            // Računanje ukupne cene
            $totalPrice = 0;
            $proizvodiData = [];

            foreach ($validated['proizvodi'] as $item) {
                $proizvod = ProizvodNaMeniju::findOrFail($item['id']);
                
                // Provera da li je proizvod dostupan
                if (!$proizvod->is_available) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Proizvod "' . $proizvod->name . '" nije dostupan'
                    ], 400);
                }

                // Provera da li proizvod pripada restoranu
                if ($proizvod->restoran_id != $validated['restoran_id']) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Proizvod "' . $proizvod->name . '" ne pripada odabranom restoranu'
                    ], 400);
                }

                $proizvodiData[$proizvod->id] = [
                    'quantity' => $item['quantity'],
                    'price' => $proizvod->price
                ];

                $totalPrice += $proizvod->price * $item['quantity'];
            }

            // Kreiranje porudžbine
            $porudzbina = Porudzbina::create([
                'user_id' => Auth::id(),
                'restoran_id' => $validated['restoran_id'],
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'total_price' => $totalPrice,
                'delivery_address' => $validated['delivery_address'],
                'note' => $validated['note'] ?? null,
                'status' => 'pending',
            ]);

            // Povezivanje proizvoda sa porudžbinom
            $porudzbina->proizvodi()->attach($proizvodiData);

            DB::commit();

            $porudzbina->load(['restoran', 'proizvodi', 'user']);

            return response()->json([
                'success' => true,
                'message' => 'Porudžbina uspešno kreirana',
                'data' => new PorudzbinaResource($porudzbina)
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Greška pri kreiranju porudžbine: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Prikaz jedne porudžbine
     */
    public function show(Porudzbina $porudzbina): JsonResponse
    {
        // Provera da li porudžbina pripada korisniku
        if ($porudzbina->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Nemate pristup ovoj porudžbini'
            ], 403);
        }

        $porudzbina->load(['restoran', 'proizvodi', 'user']);

        return response()->json([
            'success' => true,
            'data' => new PorudzbinaResource($porudzbina)
        ]);
    }

    /**
     * Ažuriranje statusa porudžbine (samo admin)
     */
    public function updateStatus(Request $request, Porudzbina $porudzbina): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,on_delivery,delivered,cancelled'
        ]);

        $porudzbina->update(['status' => $validated['status']]);

        return response()->json([
            'success' => true,
            'message' => 'Status porudžbine uspešno ažuriran',
            'data' => new PorudzbinaResource($porudzbina)
        ]);
    }

    /**
     * Otkazivanje porudžbine
     */
    public function cancel(Porudzbina $porudzbina): JsonResponse
    {
        // Provera da li porudžbina pripada korisniku
        if ($porudzbina->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Nemate pristup ovoj porudžbini'
            ], 403);
        }

        // Provera da li se porudžbina može otkazati
        if (!in_array($porudzbina->status, ['pending', 'confirmed'])) {
            return response()->json([
                'success' => false,
                'message' => 'Porudžbina se ne može otkazati u trenutnom statusu'
            ], 400);
        }

        $porudzbina->update(['status' => 'cancelled']);

        return response()->json([
            'success' => true,
            'message' => 'Porudžbina uspešno otkazana'
        ]);
    }
}
