<?php

namespace App\Http\Controllers;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Report;
use App\Models\Commnet;
use App\Models\PostImage;
use App\Models\ReportCategory;
use Illuminate\Http\Request;
use App\Notifications\NewFollower;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use App\Notifications\LikeNotification;
use App\Notifications\CommentNotification;
use Illuminate\Contracts\Session\Session;

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
        $image = PostImage::all();
        return view('post.home',compact('post','image'));
    }

    // Post Create form
    public function create()
    {
        return view('post.create_post');
    }


    // Post Create Method
    public function store()
    {
        $hello =request()->caption;
        $hello = str_replace(' ', '_', $hello);
        $command = escapeshellcmd('python '.getcwd().'/python/main.py '.$hello);
        $output = shell_exec($command);
        
        $post = Post::create([
            'caption' => request('caption'),
            'type' => request('type'),
            'user_id' => Auth::id(),
            'emotion'=>$output
        ]);

        if(request('image'))
        {
            foreach (request()->image as $value) 
                {
                    $images = $value->store('posts','public');
                    PostImage::create([
                        'post_id'=>$post->id,
                        'user_id'=>$post->user_id,
                        'image'=>$images,
                    ]);
                }
            }

        return redirect()->route('post.home')->with('success','Post Created Successfully!');
    }


    // Post Details View Method
    public function detailView($post_id)
    {
        $recat = ReportCategory::all();
        $post = Post::findOrFail($post_id);
        $report = Report::where('post_id',$post_id);
        $image = PostImage::where('post_id',$post_id)->get();
        $comments = Commnet::where('post_id',$post_id)->get();
        return view('post.detail', compact('post','comments', 'image','recat','report'));
    }

    // Post Update Form
    public function updateView($id)
    {
        $post = Post::find($id);
        $image = PostImage::where('post_id',$id)->get();
        return view('post.update', compact('post','image'));
    }

    // Post Update Method
    public function update($id)
    {
        $request = request()->except(['_token','_method','image']);
        $post = Post::find($id);
        $post->update($request);
        
        if(request('image'))
        {
            foreach (request()->image as $value) 
            {
                $images = $value->store('posts','public');
                PostImage::create([
                    'post_id'=>$post->id,
                    'user_id'=>Auth::user()->id,
                    'image'=>$images,
                ]);
            }
        }

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


public function deleteImage($image_id)
{
    PostImage::findOrFail($image_id)->delete();
    return redirect()->back();
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

    // Report Method
    public function makeReport($post_id)
    {
        

        $user_id = Auth::user()->id;
        $post = Post::findOrFail($post_id);
        $report = Report::where('reporter_id',$user_id)->where('post_id',$post_id)->exists();
        if($post->user_id != $user_id && $report == false)
        {
            Report::create([
                'report_category_id'=>request()->report_id,
                'post_id'=>$post_id,
                'reporter_id'=>$user_id
            ]);
            return redirect()->back();
        }
        return redirect()->back();
    }
}
