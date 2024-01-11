<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
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
            if(Auth::attempt(['username' => $request->username, 'password' => $request->password])):
                return redirect()->intended('/user/home');
            endif;
            return redirect()->back()->with('message', 'Invalid Credentials');

        }catch(\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    public function index(){
        return view('userend.index');
    }
}
