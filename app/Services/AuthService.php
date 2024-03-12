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


    public function logout(string $guardName): bool
    {
        try {
            Auth::guard($guardName)->logout();
            return true;
        } catch (\Exception $e) {
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . $e);
            throw $e;
        }
    }


    public function loginUser(array $credentials): \Illuminate\Http\RedirectResponse
    {
        try {
            if (Auth::guard('web')->attempt($credentials)) {
                return redirect()->intended();
            }

            return redirect()->back()->with('message', 'Invalid Credentials');
        } catch (\Exception $e) {
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . $e);

            return redirect()->back()->with('message', $e->getMessage());
        }
    }
}
