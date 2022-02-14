<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Group;
use App\Models\PostImage;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $joinedGroup = GroupMember::where('user_id',Auth::user()->id)->get();
        $myGroup = Group::where('user_id',Auth::user()->id)->get();
        return view('groups.index',compact('groups','myGroup','joinedGroup'));
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

    public function homeGroup($group_id)
    {
        $user = Auth::user();
        $permission = GroupMember::where('user_id',$user->id)
                    ->where('group_id',$group_id)
                    ->where('status',true)->exists();

        $group = Group::find($group_id);
        $admin = false;
        if ($group->user_id == $user->id) {
            $permission = true;
            $admin=true;
        }

        $post = Post::where('group_id',$group_id)->latest()->get();
        return view('groups.group_home',compact('post','group_id','group','permission','admin'));
    }

    public function createGroupPost($group_id)
    {
        $emotion = 'None';

        if(request('emotion')){
            $hello = request()->caption;
            $hello = str_replace(' ', '_', $hello);
            $command = escapeshellcmd('python ' . getcwd() . '/python/main.py ' . $hello);
            $emotion = shell_exec($command);
        }

        $post = Post::create([
            'caption' => request('caption'),
            'type' => 'logged',
            'user_id' => Auth::id(),
            'group_id'=>$group_id,
            'emotion' => $emotion
        ]);

        if (request('image')) {
            foreach (request()->image as $value) {
                $images = $value->store('posts', 'public');
                PostImage::create([
                    'post_id' => $post->id,
                    'user_id' => $post->user_id,
                    'image' => $images,
                ]);
            }
        }

        return redirect()->back()->with('post_created', 'Post Created Successfully!');
    }

    public function joinGroupRequest($group_id)
    {
        $request_list = GroupMember::where('group_id',$group_id)
                        ->where('status',0)->get();
        $group=Group::find($group_id);
        return view('groups.join',compact('request_list','group'));
    }

    public function joinGroupRequestApprove($member_id)
    {
        GroupMember::find($member_id)->update(['status'=>true]);
        return redirect()->back();
    }

    public function approvedMembers($group_id)
    {
        $group = Group::find($group_id);
        $members = GroupMember::where('group_id',$group_id)->where('status',true)->get();
        return view('groups.members',compact('group','members'));
    }

    public function removeMembers($member_id)
    {
        GroupMember::find($member_id)->delete();
        return redirect()->back();
    }
    
}
