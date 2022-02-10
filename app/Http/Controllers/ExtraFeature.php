<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class ExtraFeature extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function search(Request $request)
    {
        $user = User::where('name', 'LIKE', '%'.$request->input('search').'%')
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('search.search_res', compact('user'));
    }

    public function suggest()
    {
        $people = User::where('id','!=',Auth::user()->id)->paginate(5);
        return view('profiles.find_firend', compact('people'));
    }

    public function sidebar()
    {
        $user = User::all();
        return view('layout.sidebar', compact('user'));
    }

    // Groups Methods Starts Here
    
    public function showGroups()
    {
        $groups = Group::all();
        return view('groups.index',compact('groups'));
    }

    public function groupCreateView()
    {
        return view('groups.create');
    }

    public function createGroup()
    {
        request()->validate([
            'name'=>'required',
            'privacy'=>'required',
            'about'=>'required',
            'image'=>['required','image']
        ]);
        
        $image = request()->image->store('/group/cover','public');
        
        $group = Group::create([
            'user_id'=>Auth::user()->id,
            'name'=>request()->name,
            'privacy'=>request()->privacy,
            'about'=>request()->about,
            'image'=>$image
        ]);

        return redirect()->route('groups')->with('group_created',$group->name.' created successfully');
    }

    public function joinGroup($group_id)
    {
        $group = Group::FindOrFail($group_id);

        if ($group->privacy == 'public') {
            GroupMember::create([
                'group_id'=> $group_id,
                'user_id'=> Auth::user()->id,
                'status'=>true
            ]);
            return redirect()->back();
        }
        else{
            GroupMember::create([
                'group_id'=> $group_id,
                'user_id'=> Auth::user()->id,
            ]);
            return redirect()->back();
        }
    }
    
}
