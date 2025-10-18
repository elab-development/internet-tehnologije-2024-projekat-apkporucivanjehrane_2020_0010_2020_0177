<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProizvodNaMenijuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => (float) $this->price,
            'image' => $this->image,
            'is_available' => (bool) $this->is_available,
            'restoran' => new RestoranResource($this->whenLoaded('restoran')),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
