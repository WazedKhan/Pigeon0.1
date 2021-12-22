<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Events\Validated;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $post = Post::orderBy('updated_at', 'desc')->get();
        return view('post.home',compact('post'));
    }

    public function create()
    {
        return view('post.create_post');
    }

    public function store()
    {
        if(request('image')){
            $imagePath = request('image')->store('media/posts','public');
        }
        else
        {
            $imagePath='Null';
        }
        Post::create([
            'caption' => request('caption'), 
            'type' => request('type'),
            'image' => $imagePath, 
            'user_id' => Auth::id()
        ]);
        return redirect()->route('post.home')->with('success','Post Created Successfully!');
    }

    public function detailView($post_id)
    {
        $post = Post::find($post_id);
        return view('post.detail', compact('post'));
    }

    public function updateView($id)
    {
        $post = Post::find($id);
        return view('post.update', compact('post'));
    }

    public function update($id)
    {
        $request = request()->except(['_token','_method']);

        $post = Post::find($id);
        if(request('image')){
            $image_path  = request('image')->store('/storage/profile','public');
            $imageArray = ['image'=>$image_path];
        }
        $post->update(array_merge(
            $request,
            $imageArray ?? [],
        ));

        return redirect()->route('post.detail',$post->id)
            ->with('success','Post updated successfully');
    }
}
