<?php

namespace App\Http\Controllers;

use App\Models\AdminDataDetails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminDataDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLoginForm()
    {
        return view('backend.adminLogin');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request): RedirectResponse
    {
        // $credentials = $request->only('username', 'password');

        $credentials = $request->validate([
            'username' => 'bail|required',
            'password' => 'required',
        ]);

        try{
            if(Auth::attempt($credentials)):
                return redirect()->intended('/dashboard')->with('username', $credentials['username']);
            endif;
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
                    
        return redirect()->back()->with('error', 'Credentials do not match!');
    }


    //Logout Functionality
    public function logout(Request $request){

        try{
            return redirect('admin-login')->with(Auth::logout());
        }catch(\Exception $e){
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminDataDetails $adminDataDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminDataDetails $adminDataDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminDataDetails $adminDataDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminDataDetails $adminDataDetails)
    {
        //
    }
}
