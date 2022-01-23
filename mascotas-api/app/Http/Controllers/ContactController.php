<?php

namespace App\Http\Controllers;

use App\Repositories\ContactRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    protected $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getOwnerSharedPets(): JsonResponse
    {
        $sharedPets = $this->contactRepository->getOwnerSharedPets(Auth::user()->id);

        return response()->json([
            'success' => true,
            'data' => compact('sharedPets'),
        ]);
    }

    public function getProfessionalSharedPets(): JsonResponse
    {
        $sharedPets = $this->contactRepository->getProfessionalSharedPets(Auth::user()->id);

        return response()->json([
            'success' => true,
            'data' => compact('sharedPets'),
        ]);
    }

    public function createSharedPetRequest(Request $request): JsonResponse
    {
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

    public function updateSharedPetRequest(Request $request, int $request_id): JsonResponse
    {
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
        $request = $this->contactRepository->acceptSharedPetRequest($request_id);

        return response()->json([
            'success' => true,
            'data' => compact('request'),
        ]);
    }

    public function deleteSharedPetRequest(int $request_id): JsonResponse
    {
        $this->contactRepository->deleteSharedPetRequest($request_id);

        return response()->json([
            'success' => true,
        ]);
    }
}
