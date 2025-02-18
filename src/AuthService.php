<?php

namespace Erick\Todo;

interface AuthService
{
    public function register(User $user);
    public function login(User $user): string;
}