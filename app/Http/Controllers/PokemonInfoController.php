<?php

namespace App\Http\Controllers;

use App\Http\Requests\PokemonInfoRequest;
use App\Services\PokemonInfoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PokemonInfoController extends Controller
{
    /** @var PokemonInfoService  */
    protected PokemonInfoService $pokemonInfoService;

    /**
     * @param PokemonInfoService $pokemonInfoService
     */
    public function __construct(PokemonInfoService $pokemonInfoService) {
        $this->pokemonInfoService = $pokemonInfoService;
    }

    /**
     * @param PokemonInfoRequest $request
     *
     * @return JsonResponse
     */
    public function index(PokemonInfoRequest $request): JsonResponse {
        $names = $request->input('names');
        $names = explode(',', $names);

        $collection = $this->pokemonInfoService->getPokemonInfo($names);

        return response()->json([
            'data' => $collection,
        ])->setStatusCode(Response::HTTP_OK);
    }
}
