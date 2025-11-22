<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannedPokemonRequest;
use App\Http\Resources\BannedPokemonResource;
use App\Models\BannedPokemon;
use App\Services\BannedPokemonService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BannedPokemonController extends Controller {
    /** @var BannedPokemonService  */
    protected BannedPokemonService $bannedPokemonService;

    /**
     * @param BannedPokemonService $bannedPokemonService
     */
    public function __construct(BannedPokemonService $bannedPokemonService) {
        $this->bannedPokemonService = $bannedPokemonService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        return response()->json([
            'status' => 'success',
            'data' => BannedPokemonResource::collection($this->bannedPokemonService->index())
        ])->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BannedPokemonRequest $request
     *
     * @return JsonResponse
     */
    public function store(BannedPokemonRequest $request): JsonResponse {
        $response = $this->bannedPokemonService->store($request->validated());

        if ($response instanceof Model) {
            return response()->json([
                'status' => 'success',
                'data' => BannedPokemonResource::make($response)
            ])->setStatusCode(Response::HTTP_CREATED);
        }

        return response()->json([
            'status' => 'error',
            'message' => $response
        ])->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BannedPokemon $bannedPokemon
     *
     * @return JsonResponse
     */
    public function destroy(BannedPokemon $bannedPokemon): JsonResponse {
        $response = $this->bannedPokemonService->destroy($bannedPokemon);

        if ($response) {
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully deleted pokemon from list of banned pokemons.'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => $response
        ]);
    }
}
