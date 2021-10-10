<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Http\Requests\UserStoreRequest;
use App\Repositories\UserTypeRepository;

class UserController extends Controller
{
    protected $userRepository;
    protected $userTypeRepository;


    public function __construct(UserRepository $userRepository, UserTypeRepository $userTypeRepository) {
        $this->userRepository = $userRepository;
        $this->userTypeRepository = $userTypeRepository;
    }

    public function create(UserStoreRequest $request) {
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
