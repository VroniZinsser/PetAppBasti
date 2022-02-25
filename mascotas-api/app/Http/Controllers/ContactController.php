<?php

namespace App\Http\Controllers;

use App\Http\Requests\SharedPets\AcceptRequest;
use App\Http\Requests\SharedPets\CreateRequest;
use App\Http\Requests\SharedPets\UpdateRequest;
use App\Models\SharedPet;
use App\Repositories\ContactRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    protected $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getRequestsByProfessional(): JsonResponse
    {
        $this->authorize('viewOwnerSharedPets', SharedPet::class);

        $professionals = $this->contactRepository->getRequestsByProfessional(Auth::user()->id);

        return response()->json([
            'success' => true,
            'data' => compact('professionals'),
        ]);
    }

    public function getOwnerSharedPets(): JsonResponse
    {
        $this->authorize('viewOwnerSharedPets', SharedPet::class);

        $sharedPets = $this->contactRepository->getOwnerSharedPets(Auth::user()->id);

        return response()->json([
            'success' => true,
            'data' => compact('sharedPets'),
        ]);
    }

    public function getProfessionalSharedPets(): JsonResponse
    {
        $this->authorize('viewProfessionalSharedPets', SharedPet::class);

        $sharedPets = $this->contactRepository->getProfessionalSharedPets(Auth::user()->id);

        return response()->json([
            'success' => true,
            'data' => compact('sharedPets'),
        ]);
    }

    public function createSharedPetRequest(CreateRequest $request): JsonResponse
    {
        $this->authorize('create', SharedPet::class);

        $requestCreated = $this->contactRepository->createSharedPetRequest(
            $request->get('description'),
            $request->get('expiration_date'),
            $request->get('pet_id'),
            Auth::user()->id,
            $request->get('professional_id'),
        );

        return response()->json([
            'success' => true,
            'data' => compact('requestCreated'),
        ]);
    }

    public function updateSharedPetRequest(UpdateRequest $request, int $request_id): JsonResponse
    {
        $request = $this->contactRepository->find($request_id);
        $this->authorize('update', $request);

        $requestUpdated = $this->contactRepository->updateSharedPetRequest(
            $request_id,
            $request->get('description'),
            $request->get('expiration_date'),
            $request->get('pet_id'),
        );

        return response()->json([
            'success' => true,
            'data' => compact('requestUpdated'),
        ]);
    }

    public function acceptSharedPetRequest(int $request_id): JsonResponse
    {
        $request = $this->contactRepository->find($request_id);
        $this->authorize('accept', $request);

        $request = $this->contactRepository->acceptSharedPetRequest($request_id);

        return response()->json([
            'success' => true,
            'data' => compact('request'),
        ]);
    }

    public function generateAcceptSharedPetRequest(int $request_id): JsonResponse
    {
        $request = $this->contactRepository->find($request_id);
        $this->authorize('accept', $request);
        
        $request = $this->contactRepository->findSharedPetRequest($request_id);

        return response()->json([
            'success' => true,
            'data' => compact('request'),
        ]);
    }

    public function deleteSharedPetRequest(int $request_id): JsonResponse
    {
        $request = $this->contactRepository->find($request_id);
        $this->authorize('delete', $request);

        $this->contactRepository->deleteSharedPetRequest($request_id);

        return response()->json([
            'success' => true,
        ]);
    }
}
