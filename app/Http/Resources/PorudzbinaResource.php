<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PorudzbinaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ime_kupca' => $this->ime_kupca,
            'email_kupca' => $this->email_kupca,
            'telefon_kupca' => $this->telefon_kupca,
            'adresa_dostave' => $this->adresa_dostave,
            'ukupna_cena' => (float) $this->ukupna_cena,
            'status' => $this->status,
            'napomena' => $this->napomena,
            'restoran' => [
                'id' => $this->restoran->id,
                'naziv' => $this->restoran->naziv,
                'cena_dostave' => (float) $this->restoran->cena_dostave,
                'vreme_dostave' => $this->restoran->vreme_dostave,
            ] when $this->relationLoaded('restoran'),
            'jela' => $this->whenLoaded('jela', function () {
                return $this->jela->map(function ($jelo) {
                    return [
                        'id' => $jelo->id,
                        'naziv' => $jelo->naziv,
                        'kolicina' => $jelo->pivot->kolicina,
                        'cena_stavke' => (float) $jelo->pivot->cena_stavke,
                    ];
                });
            }),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
