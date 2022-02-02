<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    public function send(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'mail'=>'required'
        ]);
        if (User::where('email',$request->mail)->exists()) {
            Mail::to($request->mail)->send(new PasswordResetMail($request));
            return redirect()->back()->with('email','An email is sent your email');
        }
        else
        {
            return redirect()->back()->with('email','Email address invalide');
        }
    }

    public function resetView($token, $mail)
    {
        return view('auth.reset_password',compact('token','mail'));
    }

    public function resetPassword()
    {
        $user = User::whereEmail(request()->mail)->first();
        $user->update([
            'password'=>bcrypt(request()->password)
        ]);
        return redirect()->route('login');
    }
}
