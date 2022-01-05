<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Post;

class ReportController extends Controller
{
    public function post_report($post_id)
    {
        $post = Post::find($post_id)->first();
        Report::create([
            'post_id'=>$post->id,
            'user_id'=>Auth::user()->id,
            'content'=>request()->report
        ]);
        return redirect()->back();
    }

    public function reports_view()
    {
        $reports = Report::all();
        return view('admin.user.report', compact('reports'));
    }
    public function report_create()
    {
        Report::create([
            'user_id'=>Auth::user()->id,
            'report'=>request()->report
        ]);
        return redirect()->back();
    }
}
