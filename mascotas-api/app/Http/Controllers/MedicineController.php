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
     * @param $pet_id
     * @return JsonResponse
     */
    public function add(AddRequest $request, $pet_id): JsonResponse
    {
        $medicine = $this->medicineRepository->add(
            $request->get('name'),
            $request->get('quantity'),
            $request->get('start_date'),
            $request->get('end_date'),
            $pet_id,
            $request->get('hours'));

        return response()->json([
            'success' => true,
            'data' => $medicine
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
            "data" => $hours
        ]);
    }
}
