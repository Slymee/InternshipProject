<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthService
{
    public function login(array $credentials): bool
    {
        try {
            if (Auth::guard('admin')->attempt($credentials)) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . $e);
            throw $e; // Re-throw the exception for global error handling
        }
    }


    public function logout(): bool
    {
        try {
            Auth::guard('admin')->logout();
            return true;
        } catch (\Exception $e) {
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . $e);
            throw $e;
        }
    }
}
