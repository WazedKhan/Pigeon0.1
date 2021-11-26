<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfilesController extends Controller
{
    public function index($user)
    {
        $user = User::findOrFail($user);
        return view('profiles.index', compact('user'));
    }


    public function edit($user)
    {
        $user = User::find($user);
        $this->authorize('update', $user->profile);
        //dd($user->id);
        return view('profiles.edit',compact('user'));
    }

    public function update($user)
    {
        $user = User::find($user);
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title' => 'required',
            'details' => 'required',
            'url' => 'url',
            'image' => '',
        ]);
        //dd($user->profile->title);
        Auth()->user()->profile->update($data);

        return redirect("profile/{$user->id}");
    }
}
