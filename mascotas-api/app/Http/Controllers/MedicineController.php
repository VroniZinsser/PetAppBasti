<?php

namespace App\Http\Controllers;

use App\Http\Requests\Medicines\AddRequest;
use App\Models\Medicine;
use App\Repositories\HourRepository;
use App\Repositories\MedicineRepository;
use App\Repositories\PetRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    protected $medicineRepository;
    protected $hourRepository;
    protected $petRepository;

    public function __construct(MedicineRepository $medicineRepository, HourRepository $hourRepository, PetRepository $petRepository)
    {
        $this->medicineRepository = $medicineRepository;
        $this->hourRepository = $hourRepository;
        $this->petRepository = $petRepository;
    }

    /**
     * Returns all medicines of a pet
     *
     * @param $pet_id
     * @return JsonResponse
     */
    public function getMedicinesByPet($pet_id): JsonResponse
    {
        $medicines = $this->medicineRepository->getMedicinesByPet($pet_id)->values();

        return response()->json([
            'data' => compact('medicines'),
        ]);
    }

    /**
     * Add a new medication to a pet
     *
     * @param AddRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function createMedicine(AddRequest $request): JsonResponse
    {
        $pet = $this->petRepository->find($request->get('pet_id'));
        $this->authorize('create', [Medicine::class, $pet]);

        $medicine = $this->medicineRepository->create(
            $request->get('name'),
            $request->get('quantity'),
            $request->get('start_date'),
            $request->get('end_date'),
            $request->get('pet_id'),
            $request->get('hours')
        );

        return response()->json([
            'success' => true,
            'data' => compact('medicine')
        ]);
    }

    /**
     * Gets a medicine by its id
     *
     * @param $medicine_id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function findMedicine($medicine_id): JsonResponse
    {
        $medicine = $this->medicineRepository->find($medicine_id);
        $this->authorize('view', $medicine);

        return response()->json([
            'data' => compact('medicine')
        ]);
    }

    /**
     * Updates a medicine with the given id
     *
     * @param Request $request
     * @param $medicine_id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function updateMedicine(Request $request, $medicine_id): JsonResponse
    {
        $medicine = $this->medicineRepository->find($medicine_id);
        $this->authorize('update', $medicine);

        $medicine = $this->medicineRepository->update(
            $medicine,
            $request->get('name'),
            $request->get('quantity'),
            $request->get('start_date'),
            $request->get('end_date'),
            $request->get('hours')
        );

        return response()->json([
            'success' => true,
            'data' => compact('medicine')
        ]);
    }

    /**
     * Deletes a medicine with the given id
     *
     * @param $medicine_id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function deleteMedicine($medicine_id): JsonResponse
    {
        $medicine = $this->medicineRepository->find($medicine_id);
        $this->authorize('delete', $medicine);

        $this->medicineRepository->delete($medicine);

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Returns the data necessary for the creation of the form in the front-end.
     *
     * @return JsonResponse
     */
    public function addForm(): JsonResponse
    {
        $hours = $this->hourRepository->getAll();

        return response()->json([
            "data" => compact('hours')
        ]);
    }

    /**
     * Returns the data necessary for the creation of the edit form in the front-end.
     *
     * @param $medicine_id
     * @return JsonResponse
     */
    public function updateForm($medicine_id): JsonResponse
    {
        $hours = $this->hourRepository->getAll();
        $medicine = $this->medicineRepository->find($medicine_id);

        return response()->json([
            "data" => compact('hours', 'medicine')
        ]);
    }
}
