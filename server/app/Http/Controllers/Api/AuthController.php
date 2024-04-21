<?php

namespace App\Http\Controllers\Api;

use App\Dto\LoginUserDto;
use App\Dto\RegisterUserDto;
use App\Enums\HttpCode;
use App\Enums\ResponseMessage;
use App\Enums\TokenType;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Exception;

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
                    'message'       => ResponseMessage::USER_404,
                ], HttpCode::NOT_FOUND);
            }

            return response()->json([
                'message'       => ResponseMessage::LOGIN_SUCCESS,
                'access_token'  => $token,
                'token_type'    => 'Bearer'
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], HttpCode::SERVER_ERROR);
        }
    }


    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $registerUserDto = new RegisterUserDto(...$request->validated());

            [$user, $token] = $this->authService->register($registerUserDto);

            return response()->json([
                'message' => ResponseMessage::USER_REGISTERED,
                'data'          => $user,
                'access_token'  => $token,
                'token_type'    => TokenType::BEARER
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], HttpCode::SERVER_ERROR);
        }
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        $logoutUser = $this->authService->logout(auth('sanctum')->user());

        return response()->json([
            'message' => $logoutUser
                ? ResponseMessage::LOGOUT_SUCCESS
                : ResponseMessage::LOGOUT_FAILED,
            'status' => $logoutUser ? HttpCode::OK : HttpCode::BAD_REQUEST,
        ]);
    }
}
