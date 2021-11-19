<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function registerForm(Request $request)
    {
        return view('auth.register');

    }
    public function storeUser()
    {
        dd(request()->all());
        $this->validate((request()),[
            'name'=>'required',
            'username'=>'required',
            'email'=>['required','email'],
            'password'=>'required'
        ]);
        $user = User::create(request(['name','username','email','password']));
        Auth::login($user);
        return redirect()->route('post.home');
    }
    public function signIn(Request $request)
    {
        //dd($request->all());
        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']]))
        {
            return redirect()->route('post.home');
        }
        else
        {
            return redirect()->back();
        }
    }
    // Login func
    public function LoginView()
    {
        return view('auth.login');
    }
    public function logout()
    {
        $user = Auth::user();
        Auth::logout($user);
        return redirect()->route('login');
    }
}
