<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userLoginForm(){
        return view('userend.login');
    }


    //User Registration
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

    //User Login
    public function loginUser(LoginRequest $request){
        // dd($request->validated());
    }
}
