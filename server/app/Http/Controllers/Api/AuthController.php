<?php

namespace App\Http\Controllers\Api;

use App\Dto\LoginUserDto;
use App\Dto\RegisterUserDto;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Login user
     */
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $loginUserDto = new LoginUserDto(...$request->validated());

            $token = $this->authService->login($loginUserDto);

            if (is_null($token)) {
                return response()->json([
                    'message'       => 'User not found',
                ], 404);
            }

            return response()->json([
                'message'       => 'Login success',
                'access_token'  => $token,
                'token_type'    => 'Bearer'
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $registerUserDto = new RegisterUserDto(...$request->validated());

            [$user, $token] = $this->authService->register($registerUserDto);

            return response()->json([
                'message' => 'User Registered',
                'data'          => $user,
                'access_token'  => $token,
                'token_type'    => 'Bearer'
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        $logoutUser = $this->authService->logout(auth('sanctum')->user());

        return response()->json([
            'message' => $logoutUser ? 'Logout successfull' : 'Logout failed',
            'status' => $logoutUser ? 200 : 400,
        ]);
    }
}
