<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FollowController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addFollow($user)
    {
        $following_id = User::find($user);

        $following_id->following()->attach(Auth::user()->id);
        return redirect()->back();
    }

    public function unFollow($user)
    {
        $unfollow = User::find($user);

        $unfollow->following()->detach(Auth::user()->id);
        return redirect()->back();
    }
}