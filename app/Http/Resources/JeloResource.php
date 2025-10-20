<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JeloResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'naziv' => $this->naziv,
            'opis' => $this->opis,
            'cena' => (float) $this->cena,
            'slika' => $this->slika,
            'dostupno' => $this->dostupno,
            'kategorija_jela' => $this->kategorija_jela,
            'restoran' => $this->when($this->relationLoaded('restoran'), [
                'id' => $this->restoran->id,
                'naziv' => $this->restoran->naziv,
            ]),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
