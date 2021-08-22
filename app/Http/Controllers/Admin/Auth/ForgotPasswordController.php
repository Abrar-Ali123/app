<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{

    use SendsPasswordResetEmails;

    public function broker()
    {
        return Password::broker('admins');
    }


    public function showLinkRequestForm()
    {
        return view('admin.auth.email');
    }

}
