<?php

namespace App\Http\Controllers;

use App\Http\Requests\SharedPets\CreateRequest;
use App\Http\Requests\SharedPets\DeleteRequest;
use App\Http\Requests\SharedPets\UpdateRequest;
use App\Models\SharedPet;
use App\Repositories\ContactRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    protected $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * Gets all requests to share a pet emitted by the authenticated user grouped by the professionals they are related to
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function getRequestsByProfessional(): JsonResponse
    {
        $this->authorize('viewOwnerSharedPets', SharedPet::class);

        $professionals = $this->contactRepository->getRequestsByProfessional(Auth::user()->id);

        return response()->json([
            'success' => true,
            'data' => compact('professionals'),
        ]);
    }

    /**
     * Gets all requests to share a pet emitted by the authenticated user
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function getOwnerSharedPets(): JsonResponse
    {
        $this->authorize('viewOwnerSharedPets', SharedPet::class);

        $sharedPets = $this->contactRepository->getOwnerSharedPets(Auth::user()->id);

        return response()->json([
            'success' => true,
            'data' => compact('sharedPets'),
        ]);
    }

    /**
     * Gets all requests to share a pet received the authenticated professional
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function getProfessionalSharedPets(): JsonResponse
    {
        $this->authorize('viewProfessionalSharedPets', SharedPet::class);

        $sharedPets = $this->contactRepository->getProfessionalSharedPets(Auth::user()->id);

        return response()->json([
            'success' => true,
            'data' => compact('sharedPets'),
        ]);
    }

    /**
     * Create request to share a pet
     *
     * @param CreateRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
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

    /**
     * Update the request to share a pet
     *
     * @param UpdateRequest $request
     * @param int $request_id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function updateSharedPetRequest(UpdateRequest $request, int $request_id): JsonResponse
    {
        $currentRequest = $this->contactRepository->find($request_id);
        $this->authorize('update', $currentRequest);

        $requestUpdated = $this->contactRepository->updateSharedPetRequest(
            $currentRequest,
            $request->get('description'),
            $request->get('expiration_date'),
            $request->get('pet_id'),
        );

        return response()->json([
            'success' => true,
            'data' => compact('requestUpdated'),
        ]);
    }

    /**
     * Sets the accepted state of a request to true
     *
     * @param int $request_id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function acceptSharedPetRequest(int $request_id): JsonResponse
    {
        $request = $this->contactRepository->find($request_id);
        $this->authorize('accept', $request);

        $this->contactRepository->acceptSharedPetRequest($request);

        return response()->json([
            'success' => true,
            'data' => compact('request'),
        ]);
    }

    /**
     * Gets the request of a shared pet by its id
     *
     * @param int $request_id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function generateAcceptSharedPetRequest(int $request_id): JsonResponse
    {
        $request = $this->contactRepository->findSharedPetRequest($request_id);
        $this->authorize('accept', $request);

        return response()->json([
            'success' => true,
            'data' => compact('request'),
        ]);
    }

    /**
     * Deletes a request to share a pet
     *
     * @param int $request_id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function deleteSharedPetRequest(int $request_id): JsonResponse

    {
        $request = $this->contactRepository->find($request_id);
        $this->authorize('delete', $request);

        $this->contactRepository->deleteSharedPetRequest($request);

        return response()->json([
            'success' => true,
        ]);
    }
}
