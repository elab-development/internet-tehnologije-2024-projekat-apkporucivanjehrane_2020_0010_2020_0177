<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KategorijaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'naziv' => $this->naziv,
            'opis' => $this->opis,
            'slika' => $this->slika,
            'broj_restorana' => $this->whenLoaded('restorani', fn() => $this->restorani->count()),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
