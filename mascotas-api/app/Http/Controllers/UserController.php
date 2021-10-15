<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Repositories\UserTypeRepository;
use App\Repositories\ImageRepository;
use App\Http\Requests\ProfessionalCreateRequest;

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

    public function createProfessional(ProfessionalCreateRequest $request) {
        $photo = $request->get('photo');
        $profile_img_id = null;

        if ($photo) {
            $image = $this->imageRepository->uploadImage($photo, 'users/profile/', 'Perfil ' . $request->get('first_name') . ' ' . $request->get('last_name'));
            $profile_img_id = $image->id;
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
            $profile_img_id
        );

        $user->userTypes()->sync($request->get('user_types'));

        return  response()->json([
            'success' => true,
            'user' => $user
        ]);
    }

    public function createFormProfessional() {
        $user_types = $this->userTypeRepository->getProfessionals();

        return response()->json([
            'data' => compact('user_types'),
        ]);
    }
}
