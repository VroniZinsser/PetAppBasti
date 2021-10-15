<?php

namespace App\Http\Controllers;


use App\Http\Requests\Pets\AddRequest;
use App\Repositories\ImageRepository;
use App\Repositories\PetRepository;
use App\Repositories\SexRepository;
use App\Repositories\SpeciesRepository;
use Illuminate\Http\JsonResponse;

class PetsController extends Controller
{
    protected $sexRepository;
    protected $speciesRepository;
    protected $petRepository;
    protected $imageRepository;

    public function __construct(
        SexRepository $sexRepository,
        SpeciesRepository $speciesRepository,
        PetRepository $petRepository,
        ImageRepository $imageRepository
    )
    {
        $this->sexRepository = $sexRepository;
        $this->speciesRepository = $speciesRepository;
        $this->petRepository = $petRepository;
        $this->imageRepository = $imageRepository;
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

    /**
     * Agrega una mascota a la base de datos
     *
     * @param AddRequest $request
     * @return JsonResponse
     */
    public function addPet(AddRequest $request): JsonResponse
    {

        $pet = $request->all();

        if ($pet['photo']) {
            $image = $this->imageRepository->uploadImage($pet['photo'], 'pets/', 'Mascota ' . $pet['name']);

            $pet['images_id'] = $image->id;
        }

        $pet['id'] ?? $pet['id'] = null;

        $pet['images_id'] ?? $pet['images_id'] = $pet['species_id'];

        $pet = $this->petRepository->updateOrCreate(
            $pet['id'],
            $pet['breed'],
            $pet['date_of_birth'],
            $pet['name'],
            $pet['neutered'],
            $pet['temperament'],
            $pet['images_id'],
            $pet['sexes_id'],
            $pet['species_id'],
            1,
        );

        return response()->json([
            'success' => true,
            'data' => $pet,
        ]);
    }

    /**
     * Returns all user's pets
     *
     * @return JsonResponse
     */
    public function getOwnerPets(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'pets' => $this->petRepository->getOwnerPets(1)
            ],
        ]);
    }
}
