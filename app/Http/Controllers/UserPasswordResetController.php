<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserPasswordResetController extends Controller
{
    public function index()
    {
        return view('userend.forgot-password');
    }


    //Send reset mail
    public function sendResetMail(ForgotPasswordRequest $request)
    {
        $token = Str::random(64);
        try{
            DB::table('password_reset_tokens')->insert([
                'email' => $request->validated()['email'],
                'token' => $token,
                "created_at" => Carbon::now(),
            ]);
            Mail::send('userend.reset-password-link', ['token' => $token], function($message) use($request){
                $message->to($request->validated()['email']);
                $message->subject('Reset Password');
            });
            return back()->with('message', 'Your password reset link has been sent to your email.');
        }catch(\Exception $e){
            return back()->with('message', $e->getMessage());
        }
    }

    public function showNewPasswordForm(string $token){
        return view('userend.password-reset', ['token'=> $token]);
    }


    public function submitNewPassword(ResetPasswordRequest $request){
        try{
            $tokenData = DB::table('password_reset_tokens')->where('token', $request->validated()['token'])->first();
        if(!$tokenData):
            return back()->with(['message' => 'Invalid token id!!']);
        endif;
        User::where('email', $tokenData->email)->first()->update([
            'password' => Hash::make($request->validated()['new-password']),
        ]);
        DB::table('password_reset_tokens')->where('email', $tokenData->email)->delete();
        return redirect()->route('user.login')->with('message', 'Password successfully updated!!');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

}
