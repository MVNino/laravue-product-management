<?php

namespace App\Services;

use App\Dto\LoginUserDto;
use App\Dto\RegisterUserDto;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(LoginUserDto $loginUserData): string | null | Exception
    {
        try {
            if (!Auth::attempt($loginUserData->toArray())) {
                return null;
            }

            $user   = User::where('email', $loginUserData->email)->firstOrFail();

            $token  = $user->createToken('auth_token')->plainTextToken;

            return $token;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function register(RegisterUserDto $registerUserData): array | Exception
    {
        try {
            $user = User::create($registerUserData->toArray());

            $token = $user->createToken('auth_token')->plainTextToken;

            return [$user, $token];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function logout(\Illuminate\Contracts\Auth\Authenticatable|null $sanctumUser): bool
    {
        if ($sanctumUser && method_exists($sanctumUser, 'tokens')) {
            $sanctumUser->tokens()->delete();

            return true;
        }

        return false;
    }
}
