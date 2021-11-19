<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

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
        dd(Auth::User()->all()  );
        //user()->posts()->create($data);
        
    }
}
