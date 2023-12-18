<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordMailValidator;
use App\Http\Requests\ResetPasswordValidator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('backend.forgotPassword');
    }


    //send reset mail to the user
    public function sendResetMail(ForgotPasswordMailValidator $request)
    {
        $token = Str::random(64);

        // dd($request->validated()['email']);


        try{
            DB::table('password_reset_tokens')->insert([
                'email' => $request->validated()['email'],
                'token' => $token,
                "created_at" => Carbon::now(),
            ]);

            Mail::send('backend.resetPasswordLink', ['token' => $token], function($message) use($request){
                $message->to($request->validated()['email']);
                $message->subject('Reset Password');
            });
            
            return back()->with('message', 'Your password reset link has been sent to your email.');
            
    
        }catch(\Exception $e){
            dd($e);
        }
    }


    public function showNewPasswordForm(string $token){
        return view('backend.passwordReset', ['token'=> $token]);
    }


    public function submitResetPasswordForm(ResetPasswordValidator $request){

    }


   


}
