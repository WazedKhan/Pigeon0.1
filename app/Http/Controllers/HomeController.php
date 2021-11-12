<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        return view('pages.home',[
            'user' => $user,
        ]);
    }
    public function createPost(Request $data)
    {   
        # code...
    }
}
