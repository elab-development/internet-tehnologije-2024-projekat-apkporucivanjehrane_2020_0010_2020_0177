<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Porudzbina;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class EksportController extends Controller
{
    /**
     * Eksport mojih porudžbina u CSV format
     */
    public function eksportMojePorudzbine(): Response
    {
        $porudzbine = Porudzbina::with(['restoran', 'proizvodi'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $csvData = "Broj porudžbine,Restoran,Ukupna cena,Status,Adresa dostave,Datum,Proizvodi\n";

        foreach ($porudzbine as $porudzbina) {
            $proizvodi = $porudzbina->proizvodi->map(function ($proizvod) {
                return $proizvod->name . ' (x' . $proizvod->pivot->quantity . ')';
            })->implode('; ');

            $csvData .= sprintf(
                '"%s","%s","%s","%s","%s","%s","%s"' . "\n",
                $porudzbina->order_number,
                $porudzbina->restoran->name,
                number_format($porudzbina->total_price, 2, ',', '.'),
                $porudzbina->status,
                $porudzbina->delivery_address,
                $porudzbina->created_at->format('d.m.Y H:i'),
                $proizvodi
            );
        }

        $fileName = 'porudzbine_' . Auth::id() . '_' . date('Y-m-d') . '.csv';

        return response($csvData, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Content-Transfer-Encoding' => 'binary',
        ]);
    }

    /**
     * Eksport svih porudžbina (admin)
     */
    public function eksportSvePorudzbine(): Response
    {
        $porudzbine = Porudzbina::with(['restoran', 'user', 'proizvodi'])
            ->orderBy('created_at', 'desc')
            ->get();

        $csvData = "\xEF\xBB\xBF"; // UTF-8 BOM za pravilno prikazivanje srpskih karaktera
        $csvData .= "Broj porudžbine,Korisnik,Email,Restoran,Ukupna cena,Status,Adresa dostave,Datum,Proizvodi\n";

        foreach ($porudzbine as $porudzbina) {
            $proizvodi = $porudzbina->proizvodi->map(function ($proizvod) {
                return $proizvod->name . ' (x' . $proizvod->pivot->quantity . ' - ' . number_format($proizvod->pivot->price, 2, ',', '.') . ' RSD)';
            })->implode('; ');

            $csvData .= sprintf(
                '"%s","%s","%s","%s","%s","%s","%s","%s","%s"' . "\n",
                $porudzbina->order_number,
                $porudzbina->user->name,
                $porudzbina->user->email,
                $porudzbina->restoran->name,
                number_format($porudzbina->total_price, 2, ',', '.'),
                $porudzbina->status,
                $porudzbina->delivery_address,
                $porudzbina->created_at->format('d.m.Y H:i'),
                $proizvodi
            );
        }

        $fileName = 'sve_porudzbine_' . date('Y-m-d_H-i-s') . '.csv';

        return response($csvData, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Content-Transfer-Encoding' => 'binary',
        ]);
    }

    /**
     * Eksport restorana u CSV format (admin)
     */
    public function eksportRestorane(): Response
    {
        $restorani = \App\Models\Restoran::with('category')->get();

        $csvData = "\xEF\xBB\xBF"; // UTF-8 BOM
        $csvData .= "ID,Naziv,Kategorija,Adresa,Telefon,Cena dostave,Vreme dostave (min),Aktivan\n";

        foreach ($restorani as $restoran) {
            $csvData .= sprintf(
                '%d,"%s","%s","%s","%s","%s","%d","%s"' . "\n",
                $restoran->id,
                $restoran->name,
                $restoran->category->name,
                $restoran->address,
                $restoran->phone ?? 'N/A',
                number_format($restoran->delivery_price, 2, ',', '.'),
                $restoran->delivery_time,
                $restoran->is_active ? 'Da' : 'Ne'
            );
        }

        $fileName = 'restorani_' . date('Y-m-d') . '.csv';

        return response($csvData, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Content-Transfer-Encoding' => 'binary',
        ]);
    }
}
