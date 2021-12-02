<?php

namespace App\Http\Controllers;

use App\Dtos\PetDTO;
use App\Http\Requests\Pets\AddRequest;
use App\Repositories\ImageRepository;
use App\Repositories\PetRepository;
use App\Repositories\SexRepository;
use App\Repositories\SpeciesRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PetController extends Controller
{
    protected $sexRepository;
    protected $speciesRepository;
    protected $petRepository;
    protected $imageRepository;

    public function __construct(
        SexRepository     $sexRepository,
        SpeciesRepository $speciesRepository,
        PetRepository     $petRepository,
        ImageRepository   $imageRepository
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
     * Creates a new pet
     *
     * @param AddRequest $request
     * @return JsonResponse
     */
    public function createPet(AddRequest $request): JsonResponse
    {
        $photo = $request->get('photo');
        $image_id = $request->get('species_id');

        if ($photo) {
            $image = $this->imageRepository->uploadImage($photo, 'pets/', 'Mascota ' . $request->get('name'));
            $image_id = $image->id;
        }

        $dto = new PetDTO();
        $dto->loadFromArray($request->input());
        $dto->set_image_id($image_id);
        $owner_id = Auth::user()->id;
        $pet = $this->petRepository->updateOrCreate($dto, $owner_id);

        return response()->json([
            'success' => true,
            'data' => compact('pet'),
        ]);
    }

    /**
     * Updates a pet with the given id
     *
     * @param AddRequest $request
     * @param int $pet_id
     * @return JsonResponse
     */
    public function updatePet(AddRequest $request, int $pet_id): JsonResponse
    {
        $user_id = Auth::user()->id;

        if (!$this->petRepository->isOwner($user_id, $pet_id)) {
            return $this->denyPermission();
        }

        $dto = new PetDTO();
        $dto->loadFromArray($request->input());
        $dto->set_id($pet_id);

        if ($photo = $request->get('photo')) {
            $image = $this->imageRepository->uploadImage($photo, 'pets/', 'Mascota ' . $request->get('name'));
            $dto->set_image_id($image->id);
        }else{
//            $pet = $this->petRepository->find($pet_id);

            $dto->set_image_id($this->petRepository->find($pet_id)->images_id);
        }

        $pet = $this->petRepository->updateOrCreate($dto, $user_id);

        return response()->json([
            'success' => true,
            'data' => compact('pet'),
        ]);
    }

    /**
     * Updates or removes observation from a pet
     *
     * @param Request $request
     * @param $pet_id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function updateObservation(Request $request, $pet_id): JsonResponse
    {
        if (!$this->petRepository->isOwner(Auth::user()->id, $pet_id)) {
            return $this->denyPermission();
        }
        switch ($request->input('action')) {
            case 'update':
                $this->validateObservation($request->all());
                $observation = $request->get('data')['observation'];
                break;

            case 'delete':
                $observation = '';
                break;

            default:
                return response()->json([
                    'success' => false,
                    'msg' => 'Invalid request action'
                ], 400);
        }

        try {
            $pet = $this->petRepository->updateObservation($pet_id, $observation);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'errors' => ['pet_id' => 'No se encontró la mascota relacionada']
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => compact('pet'),
        ]);
    }

    /**
     * Returns all user's pets
     *
     * @return JsonResponse
     */
    public function getOwnerPets(): JsonResponse
    {
        $pets = $this->petRepository->getPetsByUser(Auth::user()->id);

        return response()->json([
            'success' => true,
            'data' => compact('pets'),
        ]);
    }

    public function getObservation($pet_id){
        $observation = $this->petRepository->getObservation($pet_id);

        return response()->json([
            'success' => true,
            'data' => ['observation' => $observation]
        ]);
    }

    /**
     * Gets a pet by its id
     *
     * @param $pet_id
     * @return JsonResponse
     */
    public function findPet($pet_id): JsonResponse
    {
        $pet = $this->petRepository->find($pet_id);

        return response()->json([
            'data' => compact('pet')
        ]);
    }

    /**
     * Deletes a pet with the given id
     *
     * @param $pet_id
     * @return JsonResponse
     */
    public function deletePet($pet_id): JsonResponse
    {
        if (!$this->petRepository->isOwner(Auth::user()->id, $pet_id)) {
            return $this->denyPermission();
        }

        $this->petRepository->delete($pet_id);

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Performs specific validation for the observation field
     *
     * @param $request_data
     * @throws ValidationException
     */
    private function validateObservation($request_data)
    {
        Validator::make(
            $request_data,
            ['data.observation' => 'required'],
            ['data.observation.required' => 'Por favor ingresá una observación']
        )->validate();
    }
}
