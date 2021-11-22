<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();
        return view('post.home',compact('post'));
    }

    public function create()
    {
        return view('post.create_post');
    }
    public function store()
    {
        $imagePath = request('image')->store('media/posts','public');
        //dd(request('image')->store('media','public'));
        Post::create([
            'caption' => request('caption'), 
            'image' => $imagePath, 
            'user_id' => Auth::id()
        ]);
        return redirect()->route('post.home');
    }
}
