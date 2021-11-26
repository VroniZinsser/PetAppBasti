<?php

namespace App\Http\Controllers;

use App\Http\Requests\Medicines\AddRequest;
use App\Models\Medicine;
use App\Repositories\HourRepository;
use App\Repositories\MedicineRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    protected $medicineRepository;
    protected $hourRepository;

    public function __construct(MedicineRepository $medicineRepository, HourRepository $hourRepository)
    {
        $this->medicineRepository = $medicineRepository;
        $this->hourRepository = $hourRepository;
    }

    /**
     * Add a new medication to a pet
     *
     * @param AddRequest $request
     * @return JsonResponse
     */
    public function createMedicine(AddRequest $request): JsonResponse
    {
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
     */
    public function findMedicine($medicine_id): JsonResponse
    {
        $medicine = $this->medicineRepository->find($medicine_id);
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
     */
    public function updateMedicine(Request $request, $medicine_id): JsonResponse
    {
        $medicine = $this->medicineRepository->update(
            $medicine_id,
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
     */
    public function deleteMedicine($medicine_id): JsonResponse
    {
        $this->medicineRepository->delete($medicine_id);
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
}
