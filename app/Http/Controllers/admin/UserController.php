<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('admin.user.user', compact('data'));
    }
    public function status($user_id)
    {
        $user = User::where('id',$user_id);
        $user->update(['status'=>request('status')]);
        $user=User::find($user_id);
        return redirect()->back()->with('notice', "You have ".$user->status." ".$user->username);
    }
}
