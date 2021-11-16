<?php

namespace App\Http\Controllers;

use App\Dtos\PetDTO;
use App\Http\Requests\Pets\AddRequest;
use App\Repositories\ImageRepository;
use App\Repositories\PetRepository;
use App\Repositories\SexRepository;
use App\Repositories\SpeciesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $photo = $request->get('photo');
        $images_id = $request->get('species_id');

        if ($photo) {
            $image = $this->imageRepository->uploadImage($photo, 'pets/', 'Mascota ' . $request->get('name'));
            $images_id = $image->id;
        }

        $dto = new PetDTO();
        $dto->loadFromArray($request->input());
        $dto->setImages_id($images_id);

        $pet = $this->petRepository->updateOrCreate($dto, 1);

        return response()->json([
            'success' => true,
            'data' => $pet,
        ]);
    }

    /**
     * Adds, modifieds or deletes single fields of a pet
     */
    // public function patchPet(Request $request, $pets_id): JsonResponse 
    // {  
    //     // handle observation patch if 'observation' is set in request
    //     if ($request->has('observation')) {
    //         $pet = $this->petRepository->patchObservation($pets_id, $request->get('observation'));

    //         return response()->json([
    //             'success' => true,
    //             'data' => $pet,
    //         ]);
    //     }

    //     return response()->json([
    //         'success' => true,
    //     ]);
    // }

    /**
     * Updates or removes observation
     */
    public function updateObservation(Request $request, $pet_id) {
        switch($request->input('action')) {
            case 'update':
                $request->validate([
                    'data.observation' => 'required',
                    'pets_id' => 'required|exists:pets,id|integer'
                ]);
                $observation = $request->get('data')['observation'];
                $pet = $this->petRepository->patchObservation($pet_id, $observation);

                return response()->json([
                    'success' => true,
                    'data' => $pet,
                ]);
                break;
            case 'delete':
                $this->petRepository->patchObservation($pet_id, '');

                return response()->json([
                    'success' => true,
                ]);
                break;
            default:
            return response()->json([
                'success' => false,
                'msg' => 'Invalid request action'
            ], 400);
        }
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
                'pets' => $this->petRepository->getPetsByUser(1)
            ],
        ]);
    }
}
