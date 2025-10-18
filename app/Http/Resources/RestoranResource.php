<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestoranResource extends JsonResource
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
            'slug' => $this->slug,
            'description' => $this->description,
            'address' => $this->address,
            'phone' => $this->phone,
            'image' => $this->image,
            'delivery_price' => (float) $this->delivery_price,
            'delivery_time' => $this->delivery_time,
            'is_active' => (bool) $this->is_active,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'proizvodi_count' => $this->when(isset($this->proizvodi_na_meniju_count), $this->proizvodi_na_meniju_count),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
