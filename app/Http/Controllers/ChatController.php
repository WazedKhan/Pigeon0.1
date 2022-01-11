<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\Message;
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

        $message = Message::where('user_id',Auth::user()->id)
        ->where('receiver_id',$id)
        ->orwhere('user_id',$id)
        ->where('receiver_id',Auth::user()->id)
        ->get();


        return view('chat.main',compact('user', 'chat', 'message'));
    }

    public function addText($reciver_id)
    {
        // dd($reciver_id, request()->all(), Message::all());
        Message::create([
            'user_id'=>Auth::user()->id,
            'receiver_id'=>$reciver_id,
            'message'=>request()->message
        ]);
        return redirect()->back();

    }
}
