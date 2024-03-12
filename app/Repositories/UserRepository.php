<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(array $data): \Illuminate\Http\RedirectResponse
    {
        try {
            User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            return redirect()->back()->with('message', 'User Registered.');
        } catch (\Exception $e) {
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . $e);
            return redirect()->back()->with('message', $e->getMessage());
        }
    }
}
