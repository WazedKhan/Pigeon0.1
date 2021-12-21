<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class AdminController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('admin.user.user', compact('data'));
    }

    public function posts()
    {
        $posts = Post::all();
        return view('admin.user.postList', compact('posts'));
    }
}
