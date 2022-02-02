<?php

namespace App\Http\Controllers;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Report;
use App\Models\Commnet;
use Illuminate\Http\Request;
use App\Notifications\NewFollower;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use App\Notifications\LikeNotification;
use App\Notifications\CommentNotification;

class   PostController extends Controller
{
    // Auth
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Post index view
    public function index()
    {
        $post = Post::latest()->get();
        return view('post.home',compact('post'));
    }

    // Post Create form
    public function create()
    {
        return view('post.create_post');
    }

    // Post Create Method
    public function store()
    {
        // dd(request()->all());
        $hello =request()->caption;
        $hello = str_replace(' ', '_', $hello);
        $command = escapeshellcmd('python '.getcwd().'/python/main.py '.$hello);
        $output = shell_exec($command);

        $images=array();
        if($files=request()->file('image'))
        {
            foreach($files as $file)
                {
                    $name=$file->getClientOriginalName();
                    $file->move('storage\media\posts',$name);
                    $images[]=$name;
                }
        }
        else
        {
            $images='Null';
        }
        Post::create([
            'caption' => request('caption'),
            'type' => request('type'),
            'image' => implode("|",$images),
            'user_id' => Auth::id(),
            'emotion'=>$output
        ]);
        return redirect()->route('post.home')->with('success','Post Created Successfully!');
    }

    // Post Details View Method
    public function detailView($post_id)
    {
        $post = Post::find($post_id);
        $report = Report::all();
        $comments = Commnet::where('post_id',$post_id)->get();
        return view('post.detail', compact('post','comments','report'));
    }

    // Post Update Form
    public function updateView($id)
    {
        $post = Post::find($id);
        return view('post.update', compact('post'));
    }

    // Post Update Method
    public function update($id)
    {
        $request = request()->except(['_token','_method']);

        $post = Post::find($id);
        if(request('image')){
            $image_path  = request('image')->store('/media/posts','public');
            $imageArray = ['image'=>$image_path];
        }
        $post->update(array_merge(
            $request,
            $imageArray ?? [],
        ));

        return redirect()->route('post.detail',$post->id)
            ->with('success','Post updated successfully');
    }

    // Post Delete Method
    public function delete($id)
    {
        Post::find($id)->delete();
        return redirect()->route('post.home')
            ->with('success','Post Deleted successfully');
    }

    // Post Like Method
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
            if (Auth::user()->id!=$likes->user_id) {
                User::find($likes->user_id)->notify(new LikeNotification());
            }
            return redirect()->back();
        }
    }

    // Post Comment Method
    public function commnetCreateV($post_id)
    {
        $post = Post::find($post_id);
        return view('post.comment.view', compact('post'));
    }

    // Post Comment Create Method
    public function makeComment($post_id)
    {
        $userId = Post::find($post_id);
        Commnet::create([
            'user_id'=>Auth::user()->id,
            'post_id'=>$post_id,
            'comment'=>request()->comment
        ]);
        if (Auth::user()->id!=$userId->user_id) {
            User::find($userId->user_id)->notify(new CommentNotification());
        }
        return redirect()->route('post.detail',$post_id)
            ->with('success','Commented ');
    }

    // Post Liked People list shows Method
    public function viewLikes($post_id)
    {
        $ids = Like::where('post_id', $post_id)->get('user_id');
        $like_list = User::find($ids);
        return view('post.likes', compact('like_list'));
    }
}
