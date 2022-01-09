<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ChatController extends Controller
{
    public function index()
    {
        $friends = User::all();
        // $friends->following();
        return view('chat.main',compact('friends'));
    }
}
