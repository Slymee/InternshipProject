<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //display login form
    public function index(){
        return view('backend.admin-login');
    }

    //login module
    public function login(LoginRequest $request){
        try{
            if(auth()->guard('admin')->attempt($request->only(['username', 'password']))){
                return redirect(route('admin.dashboard'));
            }
            return redirect()->back()->with('message', 'Invalid Credentials');
        }catch(\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
        }
    }


    //logout module
    public function logout(Request $request){
        Auth::guard('admin')->logout();
        return redirect('/admin-login');
    }
}
