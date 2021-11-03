<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class WeightController extends Controller
{
     /**
     * Returns all weights of a pet
     *
     * @return JsonResponse
     */
    public function getWeightsByPet($pet): JsonResponse
    {
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Adds a new weight to a pet
     *
     * @return JsonResponse
     */
    public function insertWeight($pet): JsonResponse
    {
        return response()->json([
            'success' => true,
        ]);
    }


    /**
     * Gets a weight by its id
     *
     * @return JsonResponse
     */
    public function getWeight($weight): JsonResponse
    {
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Updates a weight with the given id
     *
     * @return JsonResponse
     */
    public function updateWeight($weight): JsonResponse
    {
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Deletes a weight with the given id
     *
     * @return JsonResponse
     */
    public function deleteWeight($weight): JsonResponse
    {
        return response()->json([
            'success' => true,
        ]);
    }
}