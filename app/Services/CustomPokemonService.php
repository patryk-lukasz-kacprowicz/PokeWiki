<?php

namespace App\Services;

use App\Models\CustomPokemon;
use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CustomPokemonService {
    /** @var string  */
    protected const POKEAPI_BASE_URL = 'https://pokeapi.co/api/v2/pokemon/';

    /**
     * @return Collection
     */
    public function index(): Collection {
        return CustomPokemon::all();
    }

    /**
     * @param array $data
     *
     * @return Model | string
     */
    public function store(array $data): Model | string {
        try {
            $checkExistsInPokeApi = $this->checkExistsPokemonInPokeApi($data['name']);
            $checkExistsInDatabase = $this->checkExistsPokemonInDatabase($data['name']);

            if (!$checkExistsInDatabase && !$checkExistsInPokeApi) {
                return CustomPokemon::query()->create($data);
            }

            return 'Pokemon with this name exists!';
        } catch (\Throwable $throwable) {
            return $throwable->getMessage();
        }
    }

    /**
     * @param array $data
     * @param CustomPokemon $customPokemon
     *
     * @return Model|string
     */
    public function update(array $data, CustomPokemon $customPokemon): Model | string {
        try {
            $customPokemon->update($data);

            return $customPokemon;
        } catch (\Throwable $throwable) {
            return $throwable->getMessage();
        }
    }

    /**
     * @param CustomPokemon $customPokemon
     *
     * @return bool|string
     */
    public function destroy(CustomPokemon $customPokemon): bool | string {
        try {
            return $customPokemon->delete();
        } catch (\Throwable $throwable) {
            return $throwable->getMessage();
        }
    }

    /**
     * @param string $pokemonName
     *
     * @return bool|null
     */
    protected function checkExistsPokemonInPokeApi(string $pokemonName): ?bool {
        try {
            $response = Http::get(static::POKEAPI_BASE_URL . $pokemonName);

            if ($response->ok()) {
                return true;
            }
        } catch (\Throwable $throwable) {
            return false;
        }

        return true;
    }

    /**
     * @param string $pokemonName
     *
     * @return bool
     */
    protected function checkExistsPokemonInDatabase(string $pokemonName): bool {
        return CustomPokemon::query()->where('name', $pokemonName)->exists();
    }
}
