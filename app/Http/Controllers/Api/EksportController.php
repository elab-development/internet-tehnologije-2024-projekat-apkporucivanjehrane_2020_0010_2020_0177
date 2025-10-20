<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Porudzbina;
use App\Models\Restoran;
use Illuminate\Http\Request;

class EksportController extends Controller
{
    /**
     * Eksport porudžbina u CSV format
     */
    public function eksportPorudzbina()
    {
        $porudzbine = Porudzbina::with(['user', 'restoran', 'jela'])->get();

        $csvFileName = 'porudzbine_' . now()->format('Y_m_d_His') . '.csv';
        $handle = fopen('php://temp', 'w');

        // CSV zaglavlje
        fputcsv($handle, [
            'ID',
            'Kupac',
            'Email',
            'Telefon',
            'Restoran',
            'Ukupna cena',
            'Status',
            'Datum kreiranja',
        ]);

        // CSV podaci
        foreach ($porudzbine as $porudzbina) {
            fputcsv($handle, [
                $porudzbina->id,
                $porudzbina->ime_kupca,
                $porudzbina->email_kupca,
                $porudzbina->telefon_kupca,
                $porudzbina->restoran->naziv,
                $porudzbina->ukupna_cena,
                $porudzbina->status,
                $porudzbina->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$csvFileName}\"",
        ]);
    }

    /**
     * Eksport restorana u CSV format
     */
    public function eksportRestorana()
    {
        $restorani = Restoran::with('kategorija')->get();

        $csvFileName = 'restorani_' . now()->format('Y_m_d_His') . '.csv';
        $handle = fopen('php://temp', 'w');

        // CSV zaglavlje
        fputcsv($handle, [
            'ID',
            'Naziv',
            'Kategorija',
            'Adresa',
            'Telefon',
            'Email',
            'Cena dostave',
            'Vreme dostave',
            'Ocena',
            'Aktivan',
        ]);

        // CSV podaci
        foreach ($restorani as $restoran) {
            fputcsv($handle, [
                $restoran->id,
                $restoran->naziv,
                $restoran->kategorija->naziv,
                $restoran->adresa,
                $restoran->telefon,
                $restoran->email,
                $restoran->cena_dostave,
                $restoran->vreme_dostave,
                $restoran->ocena,
                $restoran->aktivan ? 'Da' : 'Ne',
            ]);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$csvFileName}\"",
        ]);
    }
}
