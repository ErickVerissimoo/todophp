<?php

namespace Erick\Todo\service;

use Erick\Todo\entities\User;

interface AuthService
{
    public function register(User $user);
    public function login(User $user): string;
}