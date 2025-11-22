<?php

namespace App\Services;

use App\Http\Resources\PokemonInfoResource;
use App\Models\BannedPokemon;
use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class PokemonInfoService {
    /** @var string  */
    protected const POKEAPI_BASE_URL = 'https://pokeapi.co/api/v2/pokemon/';

    /**
     * @param array $names
     *
     * @return Collection
     */
    public function getPokemonInfo(array $names): Collection {
        $allowedPokemonNames = $this->filterBannedPokemons($names);
        $results = new Collection();

        foreach ($allowedPokemonNames as $pokemonName) {
            $pokemonData = $this->getSinglePokemonData($pokemonName);

            if ($pokemonData) {
                $results->push($pokemonData);
            }
        }

        return $results;
    }

    /**
     * @param array $names
     *
     * @return array
     */
    protected function filterBannedPokemons(array $names): array {
        $bannedPokemonNames = BannedPokemon::query()->whereIn('name', $names)
            ->pluck('name')
            ->toArray();

        return array_values(array_diff($names, $bannedPokemonNames));
    }

    /**
     * @param string $pokemonName
     *
     * @return ?PokemonInfoResource
     */
    public function getSinglePokemonData(string $pokemonName): ?PokemonInfoResource {
        $cachedPokemon = Pokemon::query()->where('name', $pokemonName)->first();

        if ($cachedPokemon) {
            return PokemonInfoResource::make($cachedPokemon);
        }

        $pokemonDataFromApi = $this->fetchFromPokeApi($pokemonName);

        if ($pokemonDataFromApi) {
            $pokemon = $this->savePokemon($pokemonName, $pokemonDataFromApi);

            return PokemonInfoResource::make($pokemon);
        }

        return null;
    }

    /**
     * @param string $pokemonName
     *
     * @return array | null
     */
    protected function fetchFromPokeApi(string $pokemonName): array | null {
        try {
            $response = Http::get(self::POKEAPI_BASE_URL . $pokemonName);

            if ($response->successful()) {
                return $response->json();
            }
        } catch (\Throwable $throwable) {
            return null;
        }

        return null;
    }

    /**
     * @param string $pokemonName
     * @param array $data
     *
     * @return Model|null
     */
    protected function savePokemon(string $pokemonName, array $data): ?Model {
        return Pokemon::query()->create([
            'name' => $pokemonName,
            'pokeapi_id' => $data['id'],
            'pokeapi_data' => $data,
            'cached_at' => now(),
        ]);
    }
}
