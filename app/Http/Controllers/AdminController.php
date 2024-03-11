<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class AdminController extends Controller
{
    //display login form
    /**
     * @throws \Exception
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        try {
            return view('backend.admin-login');
        }catch (\Exception $e){
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . $e);
            throw $e;
        }
    }

    //login module
    public function login(LoginRequest $request): Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try{
            if(auth()->guard('admin')->attempt($request->only(['username', 'password']))){
                return redirect(route('admin.dashboard'));
            }
            return redirect()->back()->with('message', 'Invalid Credentials');
        }catch(\Exception $e){
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . $e);
            return redirect()->back()->with('message', $e->getMessage());
        }
    }


    //logout module
    public function logout(Request $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        Auth::guard('admin')->logout();
        return redirect('/admin-login');
    }
}
