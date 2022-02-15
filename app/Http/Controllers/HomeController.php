<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use DB;

class HomeController extends Controller
{
    public function post()
    {
        $post = Post::where('type', '=', 'public')
            ->where('group_id',null)
            ->where('share_id',null)
            ->orderBy('updated_at', 'desc')
            ->get();

        //dd($posts->id);

        return view('post.public', compact('post'));
    }
}
