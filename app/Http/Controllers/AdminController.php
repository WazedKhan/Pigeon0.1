<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Group;
use App\Models\Share;
use App\Models\Report;
use App\Models\PostImage;
use Illuminate\Http\Request;
use App\Models\ReportCategory;
use App\Notifications\AdminNotification;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin','auth']);
    }
    
    public function index()
    {
        $search = 7;
        $post_search = 7;
        $post = Post::all();
        $group = Group::all();
        $image = PostImage::all();
        $share = Share::all();


        $online = User::where('is_active',true)->get();
        $offline = User::where('is_active',false)->get();
        $blocked = User::where('status','!=','active')->get();

        // 
        $post_search_value = Post::where('created_at','>=', Carbon::now()->subDays($post_search))
        ->get();

        // 

        if (request()->search) {
            $search = request()->search;
            $data = User::where('created_at','>=', Carbon::now()->subDays($search))
            ->get();
            return view('admin.user.dashboard',
            compact('blocked','data','search','post','group','image','share','post_search','post_search_value','online','offline')); 
        }


        if(request()->post_search){
            $post_search_value = User::where('created_at','>=', Carbon::now()->subDays(request()->post_search))
            ->get();
        }

        $data = User::where('created_at','>=', Carbon::now()->subDays($search))
        ->get();

        return view('admin.user.dashboard',
        compact('blocked','data','search','post','group','image','share','post_search','post_search_value','online','offline'));
    }

    public function posts()
    {
        $posts = Post::all();
        return view('admin.user.postList', compact('posts'));
    }

    public function delete($id)
    {
        $user= Post::find($id);
        $share = Share::where('post_id',$id)->get();
        if($share->isNotEmpty()){
            foreach ($share as $value) {
                Post::where('share_id',$value->id)->first()->delete();
            }
        };
        // $user->notify(new AdminNotification());
        Post::find($id)->delete();
        return redirect()->back();
    }

    // Report

    public function reportCategorylist()
    {
        $reCat = ReportCategory::all();
        return view('admin.user.report',compact('reCat'));
    }

    public function reportCategorycreate()
    {
        ReportCategory::create(request()->except('_token'));
        return redirect()->back();
    }

    public function postReportList($post_id)
    {
        $total = 0;
        $report = Report::where('post_id',$post_id)->get();
        foreach ($report as $value) {
            $total =+ $value->report_category->point;
        }
        return view('admin.user.post_report',compact('report','total'));
    }

    public function groups()
    {
        $groups = Group::all();
        return view('admin.user.groups',compact('groups'));
    }

}
