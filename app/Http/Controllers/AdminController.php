<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('admin.user.dashboard');
    }

    public function posts()
    {
        $posts = Post::all();
        return view('admin.user.postList', compact('posts'));
    }
}
