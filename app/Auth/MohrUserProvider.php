<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\UserProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function retrieveById($identifier)
    {
        
    }

    public function retrieveByToken($identifier, $token)
    {
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
    }

    public function retrieveByCredentials(array $credentials)
    {
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
    }
}