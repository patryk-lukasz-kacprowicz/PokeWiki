<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomPokemonRequest;
use App\Http\Resources\CustomPokemonResource;
use App\Models\CustomPokemon;
use App\Services\CustomPokemonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CustomPokemonController extends Controller
{
    /** @var CustomPokemonService  */
    protected CustomPokemonService $customPokemonService;

    /**
     * @param CustomPokemonService $customPokemonService
     */
    public function __construct(CustomPokemonService $customPokemonService) {
        $this->customPokemonService = $customPokemonService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        return response()->json([
            'status' => 'success',
            'data' => CustomPokemonResource::collection($this->customPokemonService->index())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomPokemonRequest $request
     *
     * @return JsonResponse
     */
    public function store(CustomPokemonRequest $request): JsonResponse {
        $response = $this->customPokemonService->store($request->validated());

        if ($response) {
            return response()->json([
                'status' => 'success',
                'data' => CustomPokemonResource::make($response)
            ])->setStatusCode(Response::HTTP_CREATED);
        }

        return response()->json([
            'status' => 'error',
            'message' => $response
        ])->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param CustomPokemon $customPokemon
     *
     * @return JsonResponse
     */
    public function update(Request $request, CustomPokemon $customPokemon): JsonResponse {
        $response = $this->customPokemonService->update($request->validated(), $customPokemon);

        if ($response) {
            return response()->json([
                'status' => 'success',
                'data' => CustomPokemonResource::make($response)
            ])->setStatusCode(Response::HTTP_OK);
        }

        return response()->json([
            'status' => 'error',
            'message' => $response
        ])->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CustomPokemon $customPokemon
     *
     * @return JsonResponse
     */
    public function destroy(CustomPokemon $customPokemon): JsonResponse {
        $response = $this->customPokemonService->destroy($customPokemon);

        if ($response) {
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully deleted custom pokemon.'
            ])->setStatusCode(Response::HTTP_OK);
        }

        return response()->json([
            'status' => 'error',
            'message' => $response
        ])->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
