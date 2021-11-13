<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfilesController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        //dd($data);
        return view('profiles.index', [
            'user'=>$user,
        ]);
    }
}
