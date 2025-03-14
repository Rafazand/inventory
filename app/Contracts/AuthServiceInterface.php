<?php

namespace App\Contracts;

interface AuthServiceInterface
{
    public function login(array $credentials):array;
    public function logout();
    public function register(array $data);
}