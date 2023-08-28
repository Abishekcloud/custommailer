<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(){
        return view('auth.forgotpassword');
    }

    public function forgotPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
    
        $otp = mt_rand(100000, 999999); // Generate a 6-digit random OTP
    
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $otp,
            'created_at' => Carbon::now()
        ]);
    
        Mail::send('emails.forgot-password', ['otp' => $otp], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Your OTP for Password Reset');
        });
    
        return redirect()->to(route('forgotPassword'))
            ->with("success", "We have mailed your OTP for password reset.");
    }


    public function resetPassword(Request $request){
        return view('new-password');
    }

    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'otp' => 'required|numeric', 
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
    
        $otpRecord = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->otp,
            ])->first();
    
        if (!$otpRecord) {
            return redirect()->to(route('resetPassword', ['token' => $request->token]))
                ->with('error', 'Invalid OTP');
        }
       
    
        // Delete the OTP record from the database
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();
    
        // Update the user's password
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
    
        return redirect()->to(route('home.index'))->with('success', 'Password reset successful. Please log in Again.');
    }
}
