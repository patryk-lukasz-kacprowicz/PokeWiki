<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomPokemonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'origin' => $this->origin,
            'name' => $this->name,
            'description' => $this->description ?? '',
            'height' => $this->height,
            'weight' => $this->weight,
            'damage' => $this->damage,
            'type' => $this->type,
        ];
    }
}
