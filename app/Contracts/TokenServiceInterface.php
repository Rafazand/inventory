<?php

namespace App\Contracts;

interface TokenServiceInterface
{
    public function createToken($user): string;
    public function revokeTokens($user): void;
}
