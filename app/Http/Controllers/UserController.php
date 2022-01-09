<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
 
    public function registerForm(Request $request)
    {
        return view('auth.register');

    }
    public function storeUser()
    {
        //dd(request()->all());
        $this->validate((request()),[
            'name'=>'required',
            'username'=>'required',
            'email'=>['required','email'],
            'password'=>'required'
        ]);
        $user = User::create([
            'name'=> request()->name,
            'username'=>request()->username,
            'email'=>request()->email,
            'password'=>bcrypt(request()->password)
        ]);
        Auth::login($user);
        return redirect()->route('post.home');
    }
    public function signIn(Request $request)
    {
        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']]))
        {
            if(Auth::user()->status=="block")
            {
                Auth::logout(Auth::user());
                return redirect()->back()->with("Block","Your Account has been Block");
            }
            else
            {
                return redirect()->route('post.home');
            }
        }
        else
        {
            return redirect()->back()->with('Barta', 'Login Failed! +_+');
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
