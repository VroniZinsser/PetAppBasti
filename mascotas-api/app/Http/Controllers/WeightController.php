<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pets\WeightRequest;
use App\Repositories\PetRepository;
use App\Repositories\WeightRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeightController extends Controller
{
    protected $weightRepository;

    public function __construct(WeightRepository $weightRepository, PetRepository $petRepository)
    {
        $this->weightRepository = $weightRepository;
        $this->petRepository = $petRepository;
    }

    /**
     * Returns all weights of a pet
     *
     * @param $pet_id
     * @return JsonResponse
     */
    public function getWeightsByPet($pet_id): JsonResponse
    {
        $pet = $this->petRepository->find($pet_id);
        $this->authorize('viewMedicalDetails', $pet);

        $weights = $this->weightRepository->getWeightsByPet($pet_id)->values();
        return response()->json([
            'data' => compact('weights'),
        ]);
    }

    /**
     * Adds a new weight to a pet
     *
     * @param WeightRequest $request
     * @return JsonResponse
     */
    public function createWeight(WeightRequest $request): JsonResponse
    {
        $pet = $this->petRepository->find($request->get('pet_id'));
        $this->authorize('create', [Weight::class, $pet]);

        $weight = $this->weightRepository->create($request->get('date'), $request->get('weight'), $request->get('pet_id'));

        return response()->json([
            'success' => true,
            'data' => compact('weight')
        ]);
    }


    /**
     * Gets a weight by its id
     *
     * @param $weight_id
     * @return JsonResponse
     */
    public function findWeight($weight_id): JsonResponse
    {
        $weight = $this->weightRepository->find($weight_id);
        $this->authorize('view', $weight);

        return response()->json([
            'data' => compact('weight')
        ]);
    }

    /**
     * Updates a weight with the given id
     *
     * @param Request $request
     * @param $weight_id
     * @return JsonResponse
     */
    public function updateWeight(Request $request, $weight_id): JsonResponse
    {
        $weight = $this->weightRepository->find($weight_id);
        $this->authorize('update', $weight);

        $weight = $this->weightRepository->update($weight_id, $request->get('date'), $request->get('weight'));

        return response()->json([
            'success' => true,
            'data' => compact('weight')
        ]);
    }

    /**
     * Deletes a weight with the given id
     *
     * @param $weight_id
     * @return JsonResponse
     */
    public function deleteWeight($weight_id): JsonResponse
    {
        $weight = $this->weightRepository->find($weight_id);
        $this->authorize('delete', $weight);

        $this->weightRepository->delete($weight_id);

        return response()->json([
            'success' => true,
        ]);
    }
}
