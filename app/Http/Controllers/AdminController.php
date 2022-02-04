<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

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
        return view('admin.user.dashboard',compact('data',search));
    }

    public function posts()
    {
        $posts = Post::all();
        return view('admin.user.postList', compact('posts'));
    }
}
