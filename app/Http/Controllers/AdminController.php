<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Share;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\ReportCategory;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin','auth']);
    }
    
    public function index()
    {
        $search = 7;
        if (request()->search) {
            $search = request()->search;
            $data = User::where('created_at','>=', Carbon::now()->subDays($search))
            ->get();
            return view('admin.user.dashboard',compact('data','search')); 
        }
        $data = User::where('created_at','>=', Carbon::now()->subDays($search))
        ->get();
        return view('admin.user.dashboard',compact('data','search'));
    }

    public function posts()
    {
        $posts = Post::all();
        return view('admin.user.postList', compact('posts'));
    }

    public function delete($id)
    {
        $share = Share::where('post_id',$id)->get();
        if($share->isNotEmpty()){
            foreach ($share as $value) {
                Post::where('share_id',$value->id)->first()->delete();
            }
        };
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

}
