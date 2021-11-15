<?php

namespace App\Http\Controllers;

use App\Http\Requests\Medicines\AddRequest;
use App\Models\Medicine;
use App\Repositories\MedicineRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MedicinesController extends Controller
{
    protected $medicineRepository;

    public function __construct(MedicineRepository $medicineRepository)
    {
        $this->medicineRepository = $medicineRepository;
    }

    /**
     * Add a new medication to a pet
     *
     * @param AddRequest $request
     * @param $petId
     * @return JsonResponse
     */
    public function add(AddRequest $request, $petId): JsonResponse
    {
        $medicine = $this->medicineRepository->add(
            $request->get('name'),
            $request->get('quantity'),
            $request->get('start_date'),
            $request->get('end_date'),
            $petId,
            $request->get('hours'));

        return response()->json([
            'success' => true,
            'data' => $medicine
        ]);
    }
}
