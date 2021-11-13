<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create_post');
    }
    public function store()
    {
        $data = request()->validate([
            'caption'=>'required',
            'image'=>['required','image']
        ]);

        auth()->user()-posts()->create($data);
        dd(request()->all());
    }
}
