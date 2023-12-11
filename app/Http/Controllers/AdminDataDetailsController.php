<?php

namespace App\Http\Controllers;

use App\Models\AdminDataDetails;
use Illuminate\Http\Request;

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
    public function login(Request $request)
    {
        
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
