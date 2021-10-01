<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
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

        return redirect('/')->withSuccessMessage('Smoothie creado con éxito');
    }
}
