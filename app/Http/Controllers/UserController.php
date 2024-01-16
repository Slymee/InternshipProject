<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session as LaravelSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function userLoginForm(){
        return view('userend.login');
    }


    //User Registration module
    public function registerUser(RegisterUserRequest $request){
        try{
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            return redirect()->back()->with('message', 'User Registered.');
        }catch(\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    //User Login module
    public function loginUser(LoginRequest $request){
        try{
            dd(LaravelSession::get('url.intended'));
            if($url = LaravelSession::get('url.intended') && Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password])):
                return redirect($url);
            endif;
            return redirect()->back()->with('message', 'Invalid Credentials');

        }catch(\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    //User logout module
    public function logoutUser(){
        Auth::guard('web')->logout();
        return redirect()->back();
    }

    public function index(){
        return view('userend.index');
    }
}
