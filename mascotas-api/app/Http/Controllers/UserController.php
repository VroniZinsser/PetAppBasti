<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Http\Requests\UserStoreRequest;
use App\Repositories\UserTypeRepository;
use App\Repositories\ImageRepository;

class UserController extends Controller
{
    protected $userRepository;
    protected $userTypeRepository;
    protected $imageRepository;


    public function __construct(UserRepository $userRepository, UserTypeRepository $userTypeRepository, ImageRepository $imageRepository) {
        $this->userRepository = $userRepository;
        $this->userTypeRepository = $userTypeRepository;
        $this->imageRepository = $imageRepository;
    }

    public function create(UserStoreRequest $request) {
        $user = $request->all();

        if ($user['photo']) {
            $image = $this->imageRepository->uploadImage($user['photo'], '/app/public/img/users/profile/', 'Perfil ' . $user['first_name'] . ' ' . $user['last_name']);

            $user['images_id'] = $image->id;
        }

        $user = $this->userRepository->updateOrCreate(
            $request->get('id'),
            $request->get('first_name'),
            $request->get('last_name'),
            $request->get('email'),
            $request->get('email_verified_at'),
            $request->get('password'),
            $request->get('address'),
            $request->get('dni'),
            $request->get('description'),
            $request->get('web'),
            $request->get('phone_number'),
            $request->get('verified'),
        );

        $user->userTypes()->sync($request->get('user_types'));

        return  response()->json([
            'success' => true,
            'user' => $user
        ]);
    }

    public function createForm() {
        $user_types = $this->userTypeRepository->getAll();
        
        return response()->json([
            'data' => compact('user_types'),
        ]);
    }
}
