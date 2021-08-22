<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;


class ForgotPasswordController extends Controller
{

    public function sendResetLinkEmail(Request $request)
    {

        return response(['errors' => ['This is demo version']], 403);

        $request->validate([
            'email' => 'required|email'
        ]);


        if(!User::where('email','=',$request->email)->exists()){
            return response(['errors' => ['This email is not registered']], 403);

        }


        $response = Password::broker('users')->sendResetLink(
            $request->only('email')
        );

        if ($response == Password::RESET_LINK_SENT) {
            return response(['message' => 'Your password reset link sent.'], 200);
        } else {
            return response(['errors' => ['Email link already sent. please wait until 60 seconds']], 403);
        }
    }
}
