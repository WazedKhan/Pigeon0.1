<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index()
    {
        return view('profiles.index');
    }
}
