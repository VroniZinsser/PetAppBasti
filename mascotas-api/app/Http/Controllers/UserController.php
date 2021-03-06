<?php

namespace App\Http\Controllers;

use App\Dtos\UserDTO;
use App\Http\Requests\Users\Owner\CreateRequest as CreateOwnerRequest;
use App\Repositories\UserRepository;
use App\Repositories\UserTypeRepository;
use App\Repositories\ImageRepository;
use App\Http\Requests\Users\Professionals\CreateRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $userRepository;
    protected $userTypeRepository;
    protected $imageRepository;
    protected $userProfessionalTypesIds = [5, 6, 7, 8];
    protected $userOwnerTypesIds = [4];


    public function __construct(UserRepository $userRepository, UserTypeRepository $userTypeRepository, ImageRepository $imageRepository)
    {
        $this->userRepository = $userRepository;
        $this->userTypeRepository = $userTypeRepository;
        $this->imageRepository = $imageRepository;
    }

    /**
     * Returns all users with role as professional
     *
     * @return JsonResponse
     */
    public function getProfessionals(): JsonResponse
    {
        $users = $this->userRepository->getUsersByTypes($this->userProfessionalTypesIds);

        return response()->json([
            'success' => true,
            'data' => compact('users'),
        ]);
    }

    /**
     * Create a new professional user in the database
     *
     * @param CreateRequest $request
     * @return JsonResponse
     */
    public function createProfessional(CreateRequest $request): JsonResponse
    {
        $photo = $request->get('photo');
        $profile_img_id = null;

        if ($photo) {
            $image = $this->imageRepository->uploadImage($photo, 'users/profile/', 'Perfil ' . $request->get('first_name') . ' ' . $request->get('last_name'));
            $profile_img_id = $image->id;
        }

        $dto = new UserDTO;
        $dto->loadFromArray($request->input());
        $dto->set_profile_img_id($profile_img_id);

        $user = $this->userRepository->updateOrCreate($dto, $request->get('user_types'));

        return response()->json([
            'success' => true,
            'data' => compact('user'),
        ]);
    }

    /**
     * Update a professional user in the database
     *
     * @param CreateRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function updateProfessional(CreateRequest $request): JsonResponse
    {
        $user = $this->userRepository->find($request->get('id'));
        $this->authorize('update', $user);

        $dto = new UserDTO;
        $dto->loadFromArray($request->except('password'));

        if ($photo = $request->get('photo')) {
            $image = $this->imageRepository->uploadImage($photo, 'users/profile/', 'Perfil ' . $request->get('first_name') . ' ' . $request->get('last_name'));
            $dto->set_profile_img_id($image->id);
        }

        $user = $this->userRepository->updateOrCreate($dto, $request->get('user_types'), $user)->load(['profile_image']);

        return response()->json([
            'success' => true,
            'data' => compact('user'),
        ]);
    }

    /**
     * Returns the data necessary for the creation of the create professional form
     *
     * @return JsonResponse
     */
    public function getProfessionalUserTypes(): JsonResponse
    {
        $user_types = $this->userTypeRepository->getProfessionals();

        return response()->json([
            'data' => compact('user_types'),
        ]);
    }

    /**
     * Gets a user by its id
     *
     * @param $user_id
     * @return JsonResponse
     */
    public function findUser($user_id): JsonResponse
    {
        $user = $this->userRepository->find($user_id);

        return response()->json([
            'data' => compact('user')
        ]);
    }

    /**
     * Updates a pet owner
     *
     * @param CreateOwnerRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function updateOwner(CreateOwnerRequest $request): JsonResponse
    {
        $user = $this->userRepository->find($request->get('id'));
        $this->authorize('update', $user);

        $dto = new UserDTO;
        $dto->loadFromArray($request->except('password'));

        $user = $this->userRepository->updateOrCreate($dto, $this->userOwnerTypesIds, $user);

        return response()->json([
            'success' => true,
            'data' => compact('user')
        ]);
    }

    /**
     * Deletes a user with the given id
     *
     * @param $user_id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function deleteUser($user_id): JsonResponse
    {
        $user = $this->userRepository->find($user_id);
        $this->authorize('delete', $user);

        $this->userRepository->delete($user);

        return response()->json([
            'success' => true,
        ]);
    }

    /** Create a new user of type owner
     *
     * @param CreateOwnerRequest $request
     * @return JsonResponse
     */
    public function createOwner(CreateOwnerRequest $request): JsonResponse
    {
        $dto = new UserDTO;
        $dto->loadFromArray($request->input());

        $user = $this->userRepository->updateOrCreate($dto, $this->userOwnerTypesIds);

        $user->userTypes()->sync($this->userOwnerTypesIds);

        return response()->json([
            'success' => true,
            'data' => compact('user')
        ]);
    }
}
