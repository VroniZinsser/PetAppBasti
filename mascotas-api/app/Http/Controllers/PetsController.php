<?php

namespace App\Http\Controllers;


use App\Repositories\SexRepository;
use App\Repositories\SpeciesRepository;
use Illuminate\Http\JsonResponse;

class PetsController extends Controller
{
    protected $sexRepository;
    protected $speciesRepository;

    public function __construct(
        SexRepository $sexRepository,
        SpeciesRepository $speciesRepository
    )
    {
        $this->sexRepository = $sexRepository;
        $this->speciesRepository = $speciesRepository;
    }

    /**
     * Returns the data necessary for the creation of the add pet form.
     *
     * @return JsonResponse
     */
    public function addForm(): JsonResponse
    {
        $sexes = $this->sexRepository->getAll();
        $species = $this->speciesRepository->getAll();

        return response()->json([
            'data' => compact('sexes', 'species'),
        ]);
    }
}
