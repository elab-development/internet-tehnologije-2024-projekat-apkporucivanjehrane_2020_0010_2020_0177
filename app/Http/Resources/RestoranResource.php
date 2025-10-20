<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestoranResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'naziv' => $this->naziv,
            'slug' => $this->slug,
            'opis' => $this->opis,
            'adresa' => $this->adresa,
            'telefon' => $this->telefon,
            'email' => $this->email,
            'slika' => $this->slika,
            'cena_dostave' => (float) $this->cena_dostave,
            'vreme_dostave' => $this->vreme_dostave,
            'ocena' => (float) $this->ocena,
            'aktivan' => $this->aktivan,
            'kategorija' => new KategorijaResource($this->whenLoaded('kategorija')),
            'jela' => JeloResource::collection($this->whenLoaded('jela')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
