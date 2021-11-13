<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfilesController extends Controller
{
    public function index($user)
    {
        $user = User::findOrFail($user);
        //dd($data);
        return view('profiles.index', [
            'user'=>$user,
        ]);
    }
}
