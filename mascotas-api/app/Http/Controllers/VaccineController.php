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
     * @return JsonResponse
     */
    public function getVaccinesByPet($pets_id): JsonResponse
    {
        $vaccines = $this->vaccineRepository->getVaccinesByPet($pets_id);
        return response()->json([
            'data' => compact('vaccines'),
        ]);
    }

    /**
     * Adds a new vaccine to a pet
     *
     * @return JsonResponse
     */
    public function createVaccine(VaccineRequest $request): JsonResponse
    {
        $vaccine = $this->vaccineRepository->create($request->get('name'), $request->get('date'), $request->get('pets_id'));

        return response()->json([
            'success' => true,
            'data' => $vaccine,
        ]);
    }

    /**
     * Gets a vaccine by its id
     *
     * @return JsonResponse
     */
    public function findVaccine($vaccines_id): JsonResponse
    {
        $vaccine = $this->vaccineRepository->find($vaccines_id);
        
        return response()->json([
            'data' => compact('vaccine'),
        ]);
    }

    /**
     * Updates a vaccine with the given id
     *
     * @return JsonResponse
     */
    public function updateVaccine(VaccineRequest $request, $vaccines_id): JsonResponse
    {
        $vaccine = $this->vaccineRepository->update($vaccines_id, $request->get('name'), $request->get('date'), $request->get('pets_id'));
        return response()->json([
            'data' => compact('vaccine'),
        ]);
    }

    /**
     * Deletes a vaccine with the given id
     *
     * @return JsonResponse
     */
    public function deleteVaccine($vaccines_id): JsonResponse
    {
        $this->vaccineRepository->delete($vaccines_id);
        return response()->json([
            'success' => true,
        ]);
    }
}
