<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use App\Models\Commnet;
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
        
        $hello =request()->caption;
        $hello = str_replace(' ', '_', $hello);
        $command = escapeshellcmd('python '.getcwd().'/python/main.py '.$hello);
        $output = shell_exec($command);
        //dd($output);

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
            'user_id' => Auth::id(),
            'emotion'=>$output
        ]);
        return redirect()->route('post.home')->with('success','Post Created Successfully!');
    }

    public function detailView($post_id)
    {
        $post = Post::find($post_id);
        $like = Like::all();
        $comments = Commnet::where('post_id',$post_id)->get();
        //dd($comment);
        return view('post.detail', compact('post','like','comments'));
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

    public function delete($id)
    {
        Post::find($id)->delete();
        return redirect()->route('post.home')
            ->with('success','Post Deleted successfully');
    }

    public function like($post_id)
    {
        $likes = Post::find($post_id);
        if ($likes->liked()->where('user_id',Auth::user()->id)->exists()) {
            $likes->liked()->detach(Auth::user()->id);
            return redirect()->back();
        }
        else
        {
            $likes->liked()->attach(Auth::user()->id);
            return redirect()->back();
        }
    }
    
    public function commnetCreateV($post_id)
    {
        $post = Post::find($post_id);
        return view('post.comment.view', compact('post'));
    }

    public function makeComment($post_id)
    {
        //dd(request()->all());
        Commnet::create([
            'user_id'=>Auth::user()->id,
            'post_id'=>$post_id,
            'comment'=>request()->comment
        ]);
        return redirect()->route('post.detail',$post_id)
            ->with('success','Post updated successfully');
    }
    public function postLiked()
    {
        //
    }
}
