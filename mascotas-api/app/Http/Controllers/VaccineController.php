<?php

namespace App\Http\Controllers;

use App\Http\Requests\VaccineRequest;
use App\Models\Vaccine;
use App\Repositories\PetRepository;
use App\Repositories\VaccineRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class VaccineController extends Controller
{
    protected $vaccineRepository;
    protected $petRepository;

    public function __construct(VaccineRepository $vaccineRepository, PetRepository $petRepository)
    {
        $this->vaccineRepository = $vaccineRepository;
        $this->petRepository = $petRepository;
    }

    /**
     * Returns all vaccines of a pet
     *
     * @param $pet_id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function getVaccinesByPet($pet_id): JsonResponse
    {
        $pet = $this->petRepository->find($pet_id);
        $this->authorize('viewMedicalDetails', $pet);

        $vaccines = $this->vaccineRepository->getVaccinesByPet($pet_id)->values();
        return response()->json([
            'data' => compact('vaccines'),
        ]);
    }

    /**
     * Adds a new vaccine to a pet
     *
     * @param VaccineRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function createVaccine(VaccineRequest $request): JsonResponse
    {
        $pet = $this->petRepository->find($request->get('pet_id'));
        $this->authorize('create', [Vaccine::class, $pet]);

        $vaccine = $this->vaccineRepository->create($request->get('name'), $request->get('date'), $request->get('pet_id'));

        return response()->json([
            'success' => true,
            'data' => compact('vaccine'),
        ]);
    }

    /**
     * Gets a vaccine by its id
     *
     * @param $vaccine_id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function findVaccine($vaccine_id): JsonResponse
    {
        $vaccine = $this->vaccineRepository->find($vaccine_id);
        $this->authorize('view', $vaccine);

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
     * @throws AuthorizationException
     */
    public function updateVaccine(VaccineRequest $request, $vaccine_id): JsonResponse
    {
        $vaccine = $this->vaccineRepository->find($vaccine_id);
        $this->authorize('update', $vaccine);

        $vaccine = $this->vaccineRepository->update($vaccine, $request->get('name'), $request->get('date'));

        return response()->json([
            'success' => true,
            'data' => compact('vaccine'),
        ]);
    }

    /**
     * Deletes a vaccine with the given id
     *
     * @param $vaccine_id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function deleteVaccine($vaccine_id): JsonResponse
    {
        $vaccine = $this->vaccineRepository->find($vaccine_id);
        $this->authorize('delete', $vaccine);

        $this->vaccineRepository->delete($vaccine);

        return response()->json([
            'success' => true,
        ]);
    }
}
