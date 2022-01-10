<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\User;

class ChatController extends Controller
{
    public function index()
    {
        $followers = Follow::where('user_id',Auth::user()->id)->get('profile_id');
        $user = User::find($followers);
        $chat = null;
        return view('chat.main',compact('user','chat'));
    }

    public function chat($id) 
    {

        $followers = Follow::where('user_id',Auth::user()->id)->get('profile_id');
        $user = User::find($followers);
        $chat = Follow::where('profile_id',$id)->get('profile_id');
        $chat = User::find($chat)->first();
        return view('chat.main',compact('user', 'chat'));
    }

    public function addText($reciver_id)
    {
        dd($reciver_id, request()->all());

    }
}
