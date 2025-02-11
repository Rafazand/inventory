<?php

namespace App\Services;

use App\Contracts\TokenServiceInterface;
use Laravel\Sanctum\PersonalAccessToken;

class TokenService implements TokenServiceInterface
{
    public function createToken($user): string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }

    public function revokeTokens($user): void
    {
        $user->tokens()->delete();
    }
}
