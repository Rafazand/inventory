<?php

namespace App\Services\Auth;

interface AuthServiceInterface
{
    public function login(array $credentials): array;
    public function logout();
    public function register(array $data);
}
