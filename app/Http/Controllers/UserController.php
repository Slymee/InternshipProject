<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session as LaravelSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     * @throws \Exception
     */
    public function userLoginForm(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        try {
            Redirect::setIntendedUrl(url()->previous());
            return view('userend.login');
        }catch (\Exception $e){
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . json_encode($e->getTrace(), JSON_PRETTY_PRINT));
            throw $e;
        }
    }


    /**
     * User register module
     * @param RegisterUserRequest $request
     * @return RedirectResponse
     */
    public function registerUser(RegisterUserRequest $request): RedirectResponse
    {
        try{
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            return redirect()->back()->with('message', 'User Registered.');
        }catch(\Exception $e){
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . json_encode($e->getTrace(), JSON_PRETTY_PRINT));
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * User login module
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function loginUser(LoginRequest $request): RedirectResponse
    {
        try{
            if(Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password])){
                return redirect()->intended();
            }
            return redirect()->back()->with('message', 'Invalid Credentials');

        }catch(\Exception $e){
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . json_encode($e->getTrace(), JSON_PRETTY_PRINT));
            return redirect()->back()->with('message', $e->getMessage());
        }
    }


    /**
     * User logout
     * @return RedirectResponse
     * @throws \Exception
     */
    public function logoutUser(): RedirectResponse
    {
        try {
            Auth::guard('web')->logout();
            return redirect()->back();
        }catch (\Exception $e){
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . json_encode($e->getTrace(), JSON_PRETTY_PRINT));
            throw $e;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     * @throws \Exception
     */
    public function index(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        try {
            return view('userend.index');
        }catch (\Exception $e){
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . json_encode($e->getTrace(), JSON_PRETTY_PRINT));
            throw $e;
        }
    }
}
