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
    /**
     * Rename LoginFormValidator to LoginRequest
     * 
     */
    public function login(LoginRequest $request){
        try{
            if(auth()->guard('admin')->attempt($request->only(['username', 'password']))):
                return redirect(route('admin.dashboard'));
            endif;
            return redirect()->back()->with('message', 'Invalid Credentials');
             /**
             * 
             *  if there is already return function then no need to write else part.
             * 
             */
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
