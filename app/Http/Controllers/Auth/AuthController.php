<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetLinkEmailRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\EmailVerificationMail;
use App\Mail\ResetPasswordLinkMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function onLogin(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => "The provided credentials are incorrect"
            ], 401);
        }
        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
        return response()->json([
            'user'=>$user,
            'access_token' =>'Bearer '. $token
        ], 200);
    }

    function onRegister(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
        return response()->json([
            'access_token' =>'Bearer '.$token,
        ], 201);
    }

    function onLogout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => "Tokens revoked"], 200);
    }
    function ResetPasswordLinkEmail(ResetLinkEmailRequest $request)
    {
        $url_generate = URL::temporarySignedRoute('reset.password', now()->addMinute(30), ['email' => $request->email]);
        $url=str_replace(env('APP_URL'),env('APP_FRONTEND_URL'),$url_generate);
        Mail::to($request->email)->send(new ResetPasswordLinkMail($url));
        return response()->json([
            'message' => "reset password link sent on your email"
        ]);
    }

    function ResetPassword(ResetPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(["message" => "Password reset successfully"], 200);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(['message' => "Password reset successfully"], 200);
    }

    function emailVerifyLinkToEmail()
    {
        Mail::to(auth()->user()->email)->send(new EmailVerificationMail(auth()->user()));
        return response()->json([
            'message'=>"Email verification link send on your email"
        ]);
    }
    function emailVerify(Request $request)
    {
        if(!$request->user()->email_verified_at){
            $request->user()->forceFill([
                'email_verified_at'=>now()
            ])->save();
        }

        return response()->json([
            'message'=>"Email Verified"
        ]);
    }

    //php artisan make:mail ResetPasswordLink --markdown=emails.reset_password_link
    //php artisan make:mail EmailVerification --markdown=emails.email_verification
    //php artisan make:request ResetLinkEmailRequest

}
