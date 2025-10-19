<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Porudzbina;
use App\Models\Jelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PorudzbinaController extends Controller
{
    /**
     * Prikaz svih porudžbina trenutno prijavljenog korisnika
     */
    public function index(Request $request)
    {
        $porudzbine = $request->user()->porudzbine()
            ->with(['restoran', 'jela'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json($porudzbine);
    }

    /**
     * Kreiranje nove porudžbine
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'restoran_id' => 'required|exists:restorans,id',
            'ime_kupca' => 'required|string|max:255',
            'email_kupca' => 'required|email',
            'telefon_kupca' => 'required|string',
            'adresa_dostave' => 'required|string',
            'napomena' => 'nullable|string',
            'jela' => 'required|array|min:1',
            'jela.*.id' => 'required|exists:jelos,id',
            'jela.*.kolicina' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            // Izračunavanje ukupne cene
            $ukupnaCena = 0;
            $jelaZaNarucivanje = [];

            foreach ($validated['jela'] as $jeloData) {
                $jelo = Jelo::findOrFail($jeloData['id']);
                
                // Provera da li je jelo iz istog restorana
                if ($jelo->restoran_id != $validated['restoran_id']) {
                    return response()->json([
                        'message' => 'Sva jela moraju biti iz istog restorana',
                    ], 400);
                }

                $cenaStavke = $jelo->cena * $jeloData['kolicina'];
                $ukupnaCena += $cenaStavke;

                $jelaZaNarucivanje[$jelo->id] = [
                    'kolicina' => $jeloData['kolicina'],
                    'cena_stavke' => $jelo->cena,
                ];
            }

            // Kreiranje porudžbine
            $porudzbina = Porudzbina::create([
                'user_id' => $request->user()->id,
                'restoran_id' => $validated['restoran_id'],
                'ime_kupca' => $validated['ime_kupca'],
                'email_kupca' => $validated['email_kupca'],
                'telefon_kupca' => $validated['telefon_kupca'],
                'adresa_dostave' => $validated['adresa_dostave'],
                'ukupna_cena' => $ukupnaCena,
                'status' => 'nova',
                'napomena' => $validated['napomena'] ?? null,
            ]);

            // Povezivanje jela sa porudžbinom
            $porudzbina->jela()->attach($jelaZaNarucivanje);

            DB::commit();

            return response()->json([
                'message' => 'Porudžbina uspešno kreirana',
                'data' => $porudzbina->load(['restoran', 'jela']),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'message' => 'Greška pri kreiranju porudžbine',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Prikaz pojedinačne porudžbine
     */
    public function show(Request $request, Porudzbina $porudzbina)
    {
        // Provera da li korisnik ima pristup ovoj porudžbini
        if ($porudzbina->user_id !== $request->user()->id && !$request->user()->is_admin) {
            return response()->json([
                'message' => 'Nemate pristup ovoj porudžbini',
            ], 403);
        }

        return response()->json($porudzbina->load(['restoran', 'jela', 'user']));
    }

    /**
     * Ažuriranje statusa porudžbine (samo za admin)
     */
    public function updateStatus(Request $request, Porudzbina $porudzbina)
    {
        if (!$request->user()->is_admin) {
            return response()->json([
                'message' => 'Nemate autorizaciju za ovu akciju',
            ], 403);
        }

        $validated = $request->validate([
            'status' => 'required|in:nova,u_pripremi,na_putu,dostavljena,otkazana',
        ]);

        $porudzbina->update($validated);

        return response()->json([
            'message' => 'Status porudžbine uspešno ažuriran',
            'data' => $porudzbina,
        ]);
    }
}
