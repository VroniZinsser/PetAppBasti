<?php

namespace App\Http\Controllers;

use App\Http\Requests\VaccineRequest;
use App\Repositories\VaccineRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VaccineController extends Controller
{
    protected $vaccineRepository;

    public function __construct(VaccineRepository $vaccineRepository)
    {
        $this->vaccineRepository = $vaccineRepository;
    }

    /**
     * Returns all vaccines of a pet
     *
     * @param $pet_id
     * @return JsonResponse
     */
    public function getVaccinesByPet($pet_id): JsonResponse
    {
        $vaccines = $this->vaccineRepository->getVaccinesByPet($pet_id);
        return response()->json([
            'data' => compact('vaccines'),
        ]);
    }

    /**
     * Adds a new vaccine to a pet
     *
     * @param VaccineRequest $request
     * @return JsonResponse
     */
    public function createVaccine(VaccineRequest $request): JsonResponse
    {
        $vaccine = $this->vaccineRepository->create($request->get('name'), $request->get('date'), $request->get('pet_id'));

        return response()->json([
            'success' => true,
            'data' => $vaccine,
        ]);
    }

    /**
     * Gets a vaccine by its id
     *
     * @param $vaccine_id
     * @return JsonResponse
     */
    public function findVaccine($vaccine_id): JsonResponse
    {
        $vaccine = $this->vaccineRepository->find($vaccine_id);

        return response()->json([
            'data' => compact('vaccine'),
        ]);
    }

    /**
     * Updates a vaccine with the given id
     *
     * @param VaccineRequest $request
     * @param $vaccine_id
     * @return JsonResponse
     */
    public function updateVaccine(VaccineRequest $request, $vaccine_id): JsonResponse
    {
        $vaccine = $this->vaccineRepository->update($vaccine_id, $request->get('name'), $request->get('date'), $request->get('pets_id'));
        return response()->json([
            'data' => compact('vaccine'),
        ]);
    }

    /**
     * Deletes a vaccine with the given id
     *
     * @param $vaccine_id
     * @return JsonResponse
     */
    public function deleteVaccine($vaccine_id): JsonResponse
    {
        $this->vaccineRepository->delete($vaccine_id);
        return response()->json([
            'success' => true,
        ]);
    }
}
