<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\returnSelf;

class PasswordResetController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws \Exception
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        try {
            return view('backend.forgot-password');
        }catch (\Exception $e){
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . json_encode($e->getTrace(), JSON_PRETTY_PRINT));
            throw $e;
        }
    }


    //send reset mail to the user
    public function sendResetMail(ForgotPasswordRequest $request): RedirectResponse
    {
        $token = Str::random(64);
        try{
            DB::table('password_reset_tokens')->insert([
                'email' => $request->validated()['email'],
                'token' => $token,
                "created_at" => Carbon::now(),
            ]);
            Mail::send('backend.reset-password-link', ['token' => $token], function($message) use($request){
                $message->to($request->validated()['email']);
                $message->subject('Reset Password');
            });
            return back()->with('message', 'Your password reset link has been sent to your email.');
        }catch(\Exception $e){
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . json_encode($e->getTrace(), JSON_PRETTY_PRINT));
            return back()->with('message', $e->getMessage());
        }
    }


    /**
     * @throws \Exception
     */
    public function showNewPasswordForm(string $token): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        try {
            return view('backend.password-reset', ['token'=> $token]);
        }catch (\Exception $e){
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . json_encode($e->getTrace(), JSON_PRETTY_PRINT));
            throw $e;
        }
    }


    /**
     * @param ResetPasswordRequest $request
     * @return string|RedirectResponse
     * @throws \Exception
     */
    public function submitAdminNewPassword(ResetPasswordRequest $request): string|RedirectResponse
    {
        try{
            $tokenData = DB::table('password_reset_tokens')->where('token', $request->validated()['token'])->first();
        if(!$tokenData){
            return back()->with(['message' => 'Invalid token id!!']);
        }
        Admin::where('email', $tokenData->email)->first()->update([
            'password' => Hash::make($request->validated()['new-password']),
        ]);
        DB::table('password_reset_tokens')->where('email', $tokenData->email)->delete();
        return redirect()->route('admin.login')->with('message', 'Password successfully updated!!');
        }catch(\Exception $e){
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . json_encode($e->getTrace(), JSON_PRETTY_PRINT));
            throw $e;
        }
    }
}
