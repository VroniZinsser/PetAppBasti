<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Repositories\UserRepository;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth:api', ['except' => ['login', 'sendPasswordReset', 'changePassword']]);
        $this->userRepository = $userRepository;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Uno o ambos campos son incorrectos',
            ], 401);
        }

        $cookie = cookie("token", $token);
        $user = $this->userRepository->find(auth()->user()->id);
        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
            ],
        ])->cookie($cookie);
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $user = $this->userRepository->find(auth()->user()->id);
        
        return response()->json([
            'data' => [
                'user' => $user,
            ],
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        $cookie = cookie("token", null, -1);

        return response()->json(['message' => 'Se cerró la sesión con éxito'])->cookie($cookie);
    }

    /**
     * Sends an email to the request's email address with a link to reset password
     *
     * @param Request $request
     * @return JsonResponse 'success true' if the mail was sent successfully
     */
    public function sendPasswordReset(Request $request): JsonResponse {
        $request->validate(['email' => 'required|email']);

        Password::sendResetLink(
            $request->only('email')
        );

        return response()->json([
            'success' => 'true',
        ]);
    }

    /**
     * Sends token, email and new password to the backend in order to update the password savely
     *
     * @param Request $request
     * @return JsonResponse 
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
 
        $msg = '';
        $success = false;
        switch ($status) {
            case Password::PASSWORD_RESET:
                $success = true;
                break;
            case Password::INVALID_USER:
                $msg = 'El correo que ingresaste no es válido.';
                break;
            case Password::INVALID_TOKEN:
                $msg = 'El link para restablecer tu contraseña caducó.';
                break;
            default:
                $msg = 'Hubo un error inesperado. Por favor intentalo más tarde.';
            }

        return response()->json([
            'success' => $success,
            'msg' => $msg
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
