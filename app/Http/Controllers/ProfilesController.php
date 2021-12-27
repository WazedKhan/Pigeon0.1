<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($user)
    {
        $user = User::findOrFail($user);
        return view('profiles.index', compact('user'));
    }


    public function edit($user)
    {
        $user = User::find($user);
        $this->authorize('update', $user->profile);
        return view('profiles.edit',compact('user'));
    }


    public function update($user)
    {
        $user = User::find($user);
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title' => 'required',
            'details' => 'required',
            'url' => '',
            'image' => '',
        ]);

        if(request('image')){
            $image_path  = request('image')->store('/storage/profile','public');
            $imageArray = ['image'=>$image_path];
        }

        Auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? [],
        ));
        
        return redirect("profile/{$user->id}");
    }

    public function friends($user_id)
    {
        
        // $followers = $followers->followers()->id;
        $followers = Follow::where('user_id',$user_id)->get('profile_id');
        $user = User::find($followers);
        // dd($user);
        return view('profiles.firends', compact('user'));
    }

    
}
