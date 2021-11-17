<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        return view('auth.register');

    }
}
