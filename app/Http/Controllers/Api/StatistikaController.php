<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Porudzbina;
use App\Models\Restoran;
use App\Models\ProizvodNaMeniju;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class StatistikaController extends Controller
{
    /**
     * Opšta statistika sistema (admin)
     */
    public function opstaStatistika(): JsonResponse
    {
        $statistika = [
            'ukupno_restorana' => Restoran::count(),
            'aktivnih_restorana' => Restoran::where('is_active', true)->count(),
            'ukupno_proizvoda' => ProizvodNaMeniju::count(),
            'dostupnih_proizvoda' => ProizvodNaMeniju::where('is_available', true)->count(),
            'ukupno_kategorija' => Category::count(),
            'ukupno_korisnika' => User::count(),
            'ukupno_porudzbina' => Porudzbina::count(),
            
            'porudzbine_po_statusu' => Porudzbina::select('status', DB::raw('count(*) as broj'))
                ->groupBy('status')
                ->get()
                ->pluck('broj', 'status'),
            
            'ukupan_promet' => (float) Porudzbina::where('status', '!=', 'cancelled')->sum('total_price'),
            
            'prosecna_vrednost_porudzbine' => (float) Porudzbina::where('status', '!=', 'cancelled')
                ->avg('total_price'),
        ];

        return response()->json([
            'success' => true,
            'data' => $statistika
        ]);
    }

    /**
     * Najpopularniji restorani (po broju porudžbina)
     */
    public function najpopularnijiRestorani(): JsonResponse
    {
        $restorani = Restoran::withCount(['porudzbine' => function ($query) {
                $query->where('status', '!=', 'cancelled');
            }])
            ->with('category')
            ->having('porudzbine_count', '>', 0)
            ->orderBy('porudzbine_count', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($restoran) {
                return [
                    'id' => $restoran->id,
                    'naziv' => $restoran->name,
                    'kategorija' => $restoran->category->name,
                    'adresa' => $restoran->address,
                    'broj_porudzbina' => $restoran->porudzbine_count,
                    'cena_dostave' => (float) $restoran->delivery_price,
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'Top 10 najpopularnijih restorana',
            'data' => $restorani
        ]);
    }

    /**
     * Statistika po kategorijama
     */
    public function statistikaPoKategorijama(): JsonResponse
    {
        $kategorije = Category::withCount('restorani')
            ->get()
            ->map(function ($kategorija) {
                $ukupnoProizvoda = ProizvodNaMeniju::whereHas('restoran', function ($query) use ($kategorija) {
                    $query->where('category_id', $kategorija->id);
                })->count();

                $ukupnoPorudzbina = Porudzbina::whereHas('restoran', function ($query) use ($kategorija) {
                    $query->where('category_id', $kategorija->id);
                })->where('status', '!=', 'cancelled')->count();

                return [
                    'kategorija' => $kategorija->name,
                    'broj_restorana' => $kategorija->restorani_count,
                    'broj_proizvoda' => $ukupnoProizvoda,
                    'broj_porudzbina' => $ukupnoPorudzbina,
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'Statistika po kategorijama',
            'data' => $kategorije
        ]);
    }

    /**
     * Moje statistike (za ulogovanog korisnika)
     */
    public function mojeStatistike(): JsonResponse
    {
        $userId = auth()->id();

        $mojePorudzbine = Porudzbina::where('user_id', $userId)->get();

        $statistika = [
            'ukupno_porudzbina' => $mojePorudzbine->count(),
            'zavrsene_porudzbine' => $mojePorudzbine->where('status', 'delivered')->count(),
            'otkazane_porudzbine' => $mojePorudzbine->where('status', 'cancelled')->count(),
            'aktivne_porudzbine' => $mojePorudzbine->whereIn('status', ['pending', 'confirmed', 'preparing', 'on_delivery'])->count(),
            
            'ukupno_potroseno' => (float) $mojePorudzbine->where('status', '!=', 'cancelled')->sum('total_price'),
            
            'prosecna_vrednost' => $mojePorudzbine->where('status', '!=', 'cancelled')->count() > 0
                ? (float) $mojePorudzbine->where('status', '!=', 'cancelled')->avg('total_price')
                : 0,
            
            'omiljeni_restoran' => $this->omiljeniRestoran($userId),
            
            'poslednje_porudzbine' => $mojePorudzbine
                ->sortByDesc('created_at')
                ->take(5)
                ->map(function ($porudzbina) {
                    return [
                        'id' => $porudzbina->id,
                        'restoran' => $porudzbina->restoran->name,
                        'iznos' => (float) $porudzbina->total_price,
                        'status' => $porudzbina->status,
                        'datum' => $porudzbina->created_at->format('d.m.Y H:i'),
                    ];
                })
                ->values(),
        ];

        return response()->json([
            'success' => true,
            'data' => $statistika
        ]);
    }

    /**
     * Pronalaženje omiljenog restorana korisnika
     */
    private function omiljeniRestoran($userId): ?array
    {
        $omiljeni = Porudzbina::where('user_id', $userId)
            ->where('status', '!=', 'cancelled')
            ->select('restoran_id', DB::raw('count(*) as broj_porudzbina'))
            ->groupBy('restoran_id')
            ->orderBy('broj_porudzbina', 'desc')
            ->first();

        if (!$omiljeni) {
            return null;
        }

        $restoran = Restoran::find($omiljeni->restoran_id);

        return [
            'naziv' => $restoran->name,
            'broj_porudzbina' => $omiljeni->broj_porudzbina,
        ];
    }
}
