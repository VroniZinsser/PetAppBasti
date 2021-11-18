<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pets\WeightRequest;
use App\Repositories\WeightRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeightController extends Controller
{
    protected $weightRepository;

    public function __construct(
        WeightRepository $weightRepository,
    )
    {
        $this->weightRepository = $weightRepository;
    }

     /**
     * Returns all weights of a pet
     *
     * @return JsonResponse
     */
    public function getWeightsByPet($pets_id): JsonResponse
    {
        $weights = $this->weightRepository->getWeightsByPet($pets_id)->values();
        return response()->json([
            'data' => compact('weights'),
        ]);
    }

    /**
     * Adds a new weight to a pet
     *
     * @return JsonResponse
     */
    public function createWeight(WeightRequest $request): JsonResponse
    {
        $weight = $this->weightRepository->create($request->get('date'), $request->get('weight'), $request->get('pets_id'));

        return response()->json([
            'success' => true,
            'data' => $weight,
        ]);
    }


    /**
     * Gets a weight by its id
     *
     * @return JsonResponse
     */
    public function findWeight($weight_id): JsonResponse
    {
        $weight = $this->weightRepository->find($weight_id);
        return response()->json([
            'data' => compact('weight'),
        ]);
    }

    /**
     * Updates a weight with the given id
     *
     * @return JsonResponse
     */
    public function updateWeight(Request $request, $weight_id): JsonResponse
    {
        $weight = $this->weightRepository->update($weight_id, $request->get('date'), $request->get('weight'));
        return response()->json([
            'data' => compact('weight'),
        ]);
    }

    /**
     * Deletes a weight with the given id
     *
     * @return JsonResponse
     */
    public function deleteWeight($weight_id): JsonResponse
    {
        $this->weightRepository->delete($weight_id);
        return response()->json([
            'success' => true,
        ]);
    }
}