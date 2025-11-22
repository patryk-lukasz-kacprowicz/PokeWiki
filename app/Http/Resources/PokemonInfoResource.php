<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PokemonInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'pokeapi_id' => $this->pokeapi_id,
            'name' => $this->name,
            'detailed_data' => $this->pokeapi_data,
            'cached_at' => $this->cached_at->diffForHumans(),
        ];
    }
}
