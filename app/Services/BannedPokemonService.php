<?php

namespace App\Services;

use App\Models\BannedPokemon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class BannedPokemonService {
    /**
     * Method for get list of banned pokemons.
     *
     * @return Collection
     */
    public function index(): Collection {
        return BannedPokemon::all();
    }

    /**
     * Method for add pokemon to list of banned pokemons.
     *
     * @param array $bannedPokemonData
     *
     * @return Model | string
     */
    public function store(array $bannedPokemonData): Model | string {
        try {
            return BannedPokemon::query()->create($bannedPokemonData);
        } catch (Throwable $throwable) {
            return $throwable->getMessage();
        }
    }

    /**
     * Method for delete selected pokemon from list of banned pokemons.
     *
     * @param BannedPokemon $bannedPokemon
     *
     * @return bool | string
     */
    public function destroy(BannedPokemon $bannedPokemon): bool | string {
        try {
            return $bannedPokemon->delete();
        } catch (Throwable $throwable) {
            return $throwable->getMessage();
        }
    }
}
