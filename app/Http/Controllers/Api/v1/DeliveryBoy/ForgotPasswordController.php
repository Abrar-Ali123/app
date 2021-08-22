<?php

namespace App\Http\Controllers\Api\v1\DeliveryBoy;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\DeliveryBoy;


class ForgotPasswordController extends Controller
{

    public function sendResetLinkEmail(Request $request)
    {

        return response(['errors' => ['This is demo version' ]], 403);

        $request->validate([
            'email'=>'required|email'
        ]);


        if(!DeliveryBoy::where('email','=',$request->email)->exists()){
            return response(['errors' => ['This email is not registered']], 403);

        }
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = Password::broker('delivery-boys')->sendResetLink(
            $request->only('email')
        );




        if ($response == Password::RESET_LINK_SENT) {
            return response(['message' => 'Your password reset link sent.'], 200);
        } else {
            return response(['errors' => ['Email link already sent. please wait until 60 seconds']], 403);
        }
    }



}
